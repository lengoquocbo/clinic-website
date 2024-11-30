<?php
    // Cho phép CORS nếu cần
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Content-Type: application/json');
    header("Access-Control-Allow-Credentials: true");

    require_once __DIR__.'\..\Models\usermodel.php';
    require_once __DIR__.'\..\..\assets\Mail\Mail.php';
    require_once __DIR__.'\..\Services\RedisService.php';


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
    $Mailer = new Mail();

    try {

        // Đọc JSON từ request body
        $json = file_get_contents('php://input');
        error_log("Parsed JSON data: " . print_r($json, true));
        $data = json_decode($json, true);
        error_log("Decoded data: " . print_r($data, true));

        if(!isset($data['inputtype'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Thiếu loại dữ liệu'
            ]);
            exit();
        }
        
        

        switch ($data['inputtype']) {
            case 'sendmail':
                if(!isset($data['mail'])) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Thiếu thông tin mail'
                    ]);
                    exit();
                }

                $User = $usermodel->findUserByMail($data['mail']);
                if(!$User){
                    echo json_encode([
                        'success' => false,
                        'message' => 'Không tìm thấy thông tin mail'
                    ]);
                    exit();
                }
    
                $mailaddress = $data['mail'];
                $code = $Mailer->createcode();
                $_SESSION['code'] = $code;
                $_SESSION['code_exp'] = time() + (15 * 60);

                $noidung = "
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <style>
                            body {
                                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                                background-color: #f5f5f5;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 100vh;
                                margin: 0;
                            }
    
                            .container {
                                background-color: white;
                                border-radius: 8px;
                                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                                padding: 32px;
                                width: 100%;
                                max-width: 350px;
                            }
    
                            .logo {
                                display: block;
                                width: 150px;
                                margin: 0 auto 24px;
                            }
    
                            .title {
                                font-size: 24px;
                                font-weight: bold;
                                text-align: center;
                                margin-bottom: 8px;
                            }
    
                            .description {
                                color: #6b7280;
                                text-align: center;
                                margin-bottom: 24px;
                            }
    
                            .code-div {
                                display: block;
                                background-color: #C97D4D;
                                color: white;
                                font-weight: bold;
                                padding: 12px 24px;
                                border-radius: 6px;
                                text-align: center;
                                transition: background-color 0.3s;
                            }
    
                            .footer {
                                color: #6b7280;
                                font-size: 14px;
                                text-align: center;
                                margin-top: 16px;
                            }
                        </style>
                    </head>
                    <body>
                        <div class='container'>
                            
                            <h1 class='title'>VINMECLASSTEST</h1>
                            <p class='description'>Đây là mã xác thực của bạn. Xin vui lòng không chia sẻ nó với bất ký ai</p>
                            <div class='code-div'>" .$code. "</div>
                            <div class='footer'>
                                <p>If you didn't request this email, you can safely ignore it.</p>
                                <p>If you're experiencing issues, please contact VINMECLASSTEST Support.</p>
                            </div>
                        </div>
                    </body>
                    </html>
                ";
                $current_datetime = date('Y-m-d H:i:s');

                $tieude = 'MÃ XÁC THỰC ĐẾ ĐỔI MẬT KHẨU | '.$current_datetime;
                $sendmail = $Mailer->sendmail($mailaddress, $noidung, $tieude);
    
                if($sendmail === 'success') {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Gửi mail thành công'
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Gửi mail thất bại'
                    ]);
                }
                break;
            
            case 'checkcode':
                if(!isset($data['code']) || !isset($data['mail'])) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Thiếu thông tin.'
                    ]);
                    exit();
                }

                if(!isset($_SESSION['code']) || !isset($_SESSION['code_exp'])){
                    echo json_encode([
                        'success' => false,
                        'message' => 'Khong tim thay thong tin trong session'
                    ]);
                    exit();
                }

                $mail = $data['mail'];
                $resetcode = $data['code'];
                $currenttime = time();

                if($currenttime > $_SESSION['code_exp']){
                    unset($_SESSION['code']);
                    unset($_SESSION['code_exp']);
                    echo json_encode([
                        'success' => false,
                        'message' => 'Mã xác thực đã hết hạn'
                    ]);
                    exit();
                }

                if ($resetcode == $_SESSION['code'] ) {
                    unset($_SESSION['code']);
                    unset($_SESSION['code_exp']);
                    echo json_encode([
                        'success' => true,
                        'message' => 'Mã xác thực trùng khớp'
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Mã xác thực không trùng khớp'
                    ]);
                }
                    
                break;
            
            case 'updatepass':
                if(!isset($data['pwhashed']) || !isset($data['mail'])) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Thiếu thông tin mật khẩu.'
                    ]);
                    exit();
                }

                $dataupdate = array(
                    'pass' => $data['pwhashed'],
                    'mail' => $data['mail']
                );

                $responseupt = $usermodel->updatepass($dataupdate);

                if(!$responseupt) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Đổi mật khẩu thất bại. Vui lòng thử lại khi khác!'
                    ]);
                } else {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Đổi mật khẩu thành công.'
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
    } catch (Exception $e) {
        // Log lỗi chung
        
        error_log("Detailed error: " . $e->getMessage());
        error_log("Stack trace: " . $e->getTraceAsString());
        
        echo json_encode([
            'error' => error_log("Detailed error: " . $e->getMessage()),
            'success' => false,
            'message' => 'Đã xảy ra lỗi'
        ]);
    }

?>