<?php
    session_start();

    // Cho phép CORS nếu cần
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Content-Type: application/json');

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
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if(isset($data['payload'])){
            session_destroy();
            echo json_encode([
                'success' => true,
                'message' => 'bye bye'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'thieu du lieu'
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