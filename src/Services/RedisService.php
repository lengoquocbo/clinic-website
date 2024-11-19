<?php

require_once __DIR__ . '/../../vendor/predis/predis/autoload.php';// Đảm bảo đã cài Predis

class RedisService {
    private $redis;
    private $tokenPrefix = 'token:';
    private $blacklistPrefix = 'blacklist:';
    private $resetPrefix = 'reset_code:';
    
    public function __construct() {
        $this->redis = new Predis\Client([
            'scheme' => 'tcp',
            'host' => 'localhost',
            'port' => 6379
        ]);
    }
    
    public function storeCode($email, $code) {
        $key = "reset_code:{$email}";
        $data = [
            'code' => $code,
            'expires' => time() + 600 // 10 phút
        ];
        
        // Lưu vào Redis với TTL 10 phút
        $this->redis->setex($key, 600, json_encode($data));
        return true;
    }

    
    public function verifyCode($email, $code) {
        $key = "reset_code:{$email}";
        $data = $this->redis->get($key);
        
        if (!$data) {
            return false;
        }
        
        $stored = json_decode($data, true);
        return $stored['code'] === $code && $stored['expires'] > time();
    }

    public function deleteCode($email) {
        $key = "reset_code:{$email}";
        return $this->redis->del([$key]) > 0; // Trả về true nếu xóa thành công
    }

    // Lưu một giá trị với thời gian tồn tại tùy chọn
    public function saveUserToken($userId, $token, $expireTime) {
        try {
            // Lưu token active
            $this->redis->setex(
                $this->tokenPrefix . $userId,
                $expireTime,
                $token
            );
            return true;
        } catch (\Exception $e) {
            error_log('Error saving user token: ' . $e->getMessage());
            return false;
        }
    }

    // them token vao blacklist(khi ng dung )
    public function addToBlacklist($token, $reason = 'logout') {
        try {
            $blacklistKey = $this->blacklistPrefix . $token;
            
            // Lưu token vào blacklist với thông tin bổ sung
            $this->redis->hmset($blacklistKey, [
                'invalidated_at' => time(),
                'reason' => $reason,
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
            ]);

            // Set thời gian tồn tại trong blacklist
            $this->redis->expire($blacklistKey, 3600);

            return true;
        } catch (\Exception $e) {
            error_log('Error adding token to blacklist: ' . $e->getMessage());
            return false;
        }
    }

    // Xu ly log out
    public function logout($userId, $token) {
        try {
            // Thêm token vào blacklist
            $this->addToBlacklist($token, 'logout');
            
            // Xóa token active
            $this->redis->del($this->tokenPrefix . $userId);

            return true;
        } catch (\Exception $e) {
            error_log('Error during logout: ' . $e->getMessage());
            return false;
        }
    }

    //ham kiem tra xem co token trong blacklist khong
    public function isBlacklisted($token) {
        try {
            return $this->redis->exists($this->blacklistPrefix . $token);
        } catch (\Exception $e) {
            error_log('Error checking blacklist: ' . $e->getMessage());
            return true; // Trả về true để đảm bảo an toàn
        }
    }

    //lam moi thoi gian het han cua token
    public function refreshTokenExpiry($userId, $token, $expireTime = 3600) {
        try {
            if ($this->isTokenActive($userId, $token)) {
                $this->redis->expire($this->tokenPrefix . $userId, $expireTime);
                return true;
            }
            return false;
        } catch (\Exception $e) {
            error_log('Error refreshing token expiry: ' . $e->getMessage());
            return false;
        }
    }

    
    //  Dọn dẹp các token hết hạn
    public function cleanup() {
        try {
            $keys = $this->redis->keys($this->blacklistPrefix . '*');
            foreach ($keys as $key) {
                if (!$this->redis->ttl($key)) {
                    $this->redis->del($key);
                }
            }
            return true;
        } catch (\Exception $e) {
            error_log('Error during cleanup: ' . $e->getMessage());
            return false;
        }
    }
}
?>