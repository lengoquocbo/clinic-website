<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once 'RedisServer.php';

class TokenService {
    private $secretKey;
    private $algorithm;
    private $redisService;

    public function __construct() {
        $this->secretKey = $_ENV['JWT_SECRET_KEY'];
        $this->algorithm = 'HS256';
        $this->redisService = new RedisService(); // Khởi tạo RedisService
    }

    public function generateToken($user) {
        $issuedAt = time();
        $expire = $issuedAt + (60 * 60);

        $payload = [
            'iss' => 'clinic_website',
            'aud' => 'api_client',
            'iat' => $issuedAt,
            'exp' => $expire,
            'data' => [
                'user_id' => $user->userID,
                'email' => $user->mail,
                'role' => $user->role
            ]
        ];

        try {
            $token = JWT::encode($payload, $this->secretKey, $this->algorithm);
            $this->redisService->set('user_token:' . $user->id, $token, $expire - time());

            return [
                'token' => $token,
                'expires' => $expire
            ];
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