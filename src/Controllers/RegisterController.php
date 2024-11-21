<?php
    session_start();

    // Cho phép CORS nếu cần
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Content-Type: application/json');

    require_once  __DIR__.'\..\Models\usermodel.php';
    require_once __DIR__.'\..\Services\TokenService.php';
    require_once __DIR__.'\..\Services\RedisService.php';



    // Nếu là OPTIONS request (preflight), trả về 200 OK
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    // Chỉ cho phép POST request
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        
        echo json_encode([
            'success' => false,
            'message' => 'Method not allowed'
        ]);
        exit();
    }

    try {
        $token = new TokenService();
        $usermodel = new UserModel();
        $Redis = new RedisService();

        // Đọc JSON từ request body
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        // Validate input
        if (!isset($data['phone']) || !isset($data['pass']) || !isset($data['name']) || !isset($data['mail'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Thiếu thông tin đăng nhập'
            ]);
            exit();
        }

        $check = 0;

        $checkname = $usermodel->findUserByPhone($data['name']);
        if($checkname) $check+=1;
        $checkphone = $usermodel->findUserByUsername($data['phone']);
        if($checkphone) $check+=1;

        if($check == 0){
            $result = $usermodel->addUser($data);
            if($result){
                $user = $usermodel->findUserByPhone($data['phone']);
                $_SESSION['isLogin'] = true;
                $_SESSION['userID'] = $user['userID'];
                $token = $token->generateToken($user);
                $Redis->saveUserToken($user['userID'], $token, 60*60*2);
                echo json_encode([
                    'success' => true,
                    'message' => 'Đăng ký thành công',
                    'URL' => '?mod=home',
                    'token' => $token
                ]);
            } else {    
                echo json_encode([
                    'success' => false,
                    'message' => 'Đăng ký không thành công'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Số điện thoại hoặc username đã tồn tại'
            ]);
        }
    } catch (Exception $e) {
        // Log lỗi chung
        error_log("General Error: " . $e->getMessage());
        echo $e->getMessage();
        
        echo json_encode([
            'success' => false,
            'message' => 'Đã xảy ra lỗi'
        ]);
    } 
?>