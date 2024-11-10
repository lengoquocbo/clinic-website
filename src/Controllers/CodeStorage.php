<?php
require_once __DIR__ . '/../../vendor/predis/predis/autoload.php';// Đảm bảo đã cài Predis

class CodeStorage {
    private $redis;
    
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
}
?>