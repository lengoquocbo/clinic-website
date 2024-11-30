<?php
    // Cho phép CORS nếu cần
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Content-Type: application/json');
    header("Access-Control-Allow-Credentials: true");

    require_once __DIR__.'\..\Models\usermodel.php';        

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

    $usermodel = new UserModel();
    try {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if(!isset($data['type'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Thiếu loại dữ liệu'
            ]);
            exit();
        }

        switch($data['type']){
            case 'changeinfo':
                if(!isset($data['userID']) || !isset($data['newemail']) || !isset($data['newphone'])) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Thiếu thông tin thay doi'
                    ]);
                    exit();
                }
                $User = $usermodel->findUserByUserID($data['userID']);
                if(!$User){
                    echo json_encode([  
                        'success' => false,
                        'message' => 'Không tìm thấy thông tin user ID'
                    ]);
                    exit();
                } 

                $ndata = array (
                    'phone' => $data['newphone'],
                    'mail' => $data['newemail'],
                    'userID' => $data['userID']
                );
                
                $result = $usermodel->updateUser($ndata);

                if($result){
                    echo json_encode([
                        'success' => true,
                        'message' => 'Cap nhat thanh cong'
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        "message" => 'Cap nhat khong thanh cong'
                    ]);
                }
                break;
            case 'resetpass' :
                if(!isset($data['userID']) || !isset($data['oldpassword']) || !isset($data['npwhashed'])) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Thiếu thông tin thay doi'
                    ]);
                    exit();
                }
                $User = $usermodel->findUserByUserID($data['userID']);
                if(!$User){
                    echo json_encode([
                        'success' => false,
                        'message' => 'Không tìm thấy thông tin user ID'
                    ]);
                    exit();
                }
                if(!password_verify($data['oldpassword'], $User['pass'])){
                    echo json_encode([
                        'success' => false,
                        'message' => 'sai mat khau'
                    ]);
                    exit();
                }
                $ndata = array(
                    'newpass' => $data['npwhashed'],
                    'userID' => $data['userID']
                );
                
                $result = $usermodel->updatePass($ndata);

                if($result){
                    echo json_encode([
                        'success' => true,
                        'message' => 'Cap nhat thanh cong'
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        "message" => 'Cap nhat khong thanh cong'
                    ]);
                }
                break;
            default: 
                echo json_encode([
                    'success' => false,
                    'message' => 'Dữ liệu sai định dạng.'
                ]);
                break;
        }
    } catch(Exception $e){
        error_log("Detailed error: " . $e->getMessage());
        error_log("Stack trace: " . $e->getTraceAsString());
        
        echo json_encode([
            'error' => error_log("Detailed error: " . $e->getMessage()),
            'success' => false,
            'message' => 'Đã xảy ra lỗi'
        ]);
    }
?>