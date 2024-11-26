<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once 'RedisService.php';

class TokenService {
    private $secretKey;
    private $algorithm;
    private $redisService;

    public function __construct() {
        $this->secretKey = '0e#$gsj_ncs5-6at9+d1dplyf0evc%';
        $this->algorithm = 'HS256';
        $this->redisService = new RedisService(); // Khởi tạo RedisService
    }

    public function generateToken($user) {
        $payload = [
            'user_id' => $user['userID'],
            'email' => $user['mail'],
            'phone' => $user['phone'],
            'exp' => time() + 3600
        ];

        try {
            $token = JWT::encode($payload, $this->secretKey, $this->algorithm);
            return $token;
        } catch (Exception $e) {
            throw new Exception('Error generating token: ' . $e->getMessage());
        }
    }

    public function verifyToken($token) {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, $this->algorithm));
            $storedToken = $this->redisService->get('user_token:' . $decoded->data->user_id);

            if (hash_equals($storedToken, $token)) {
                return $decoded->data;
            } else {
                throw new Exception('Token mismatch');
            }
        } catch (Exception $e) {
            throw new Exception('Invalid token: ' . $e->getMessage());
        }
    }
}
?>