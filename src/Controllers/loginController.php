<?php
    // Cho phép CORS nếu cần
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Content-Type: application/json');

    require_once  __DIR__.'\..\Models\usermodel.php';

    // Nếu là OPTIONS request (preflight), trả về 200 OK
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    // Chỉ cho phép POST request
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        
        echo json_encode([
            'success' => false,
            'message' => 'Phương thức không được chấp nhận'
        ]);
        exit();
    }

    try {
        $usermodel = new User();
        // Đọc JSON từ request body
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        // Validate input
        if (!isset($data['phone']) || !isset($data['password'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Thiếu thông tin đăng nhập'
            ]);
            exit();
        }

        $phone = $data['phone'];
        $password = $data['password'];

        $user = $usermodel->checkuser($phone, $password);

        if ($user!=NULL && $password == $user['pass']) {
            // Đăng nhập thành công
            session_start();
            $_SESSION['user_id'] = $user['userID'];
            $_SESSION['user_name'] = $user['username'];

            echo json_encode([
                'success' => true,
                'message' => 'Đăng nhập thành công',
            ]);
        } else {
            // Đăng nhập thất bại
            echo json_encode([
                'success' => false,
                'message' => 'Số điện thoại hoặc mật khẩu không đúng'
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