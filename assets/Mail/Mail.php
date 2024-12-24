<?php

class Mail{

    function sendmail($mailaddress, $noidung, $tieude) {
        require "PHPMailer/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn
        require "PHPMailer/src/SMTP.php"; //nhúng thư viện vào để dùng
        require 'PHPMailer/src/Exception.php'; //nhúng thư viện vào để dùng
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);  //true: enables exceptions
        try {
            $mail->isSMTP();  
            $mail->CharSet  = "utf-8";
            $mail->Host = 'smtp.gmail.com';  //SMTP servers
            $mail->SMTPAuth = true; // Enable authentication
 
            $nguoigui = 'claudehuy29@gmail.com'; 
    
            $matkhau = 'zihb bhls zxxa pfqs';// mật khẩu của tài khoản
    
            $tennguoigui = 'VINMECLASSTEST'; 
            $mail->Username = $nguoigui; // SMTP username
            $mail->Password = $matkhau;   // SMTP password
            $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
            $mail->Port = 465;  // port to connect to                
            $mail->setFrom($nguoigui, $tennguoigui ); 
            $to = $mailaddress;
                    
            $mail->addAddress($to); //mail và tên người nhận
            $mail->isHTML(true);  // Set email format to HTML 
            $mail->Subject = $tieude;     
            $mail->Body = $noidung;
            $mail->smtpConnect( array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            ));
            $mail->send();
            return true;
        } catch (Exception $e) {
            echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
            return false;
        }

    }

    function createcode(){
        return str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    public function ConfirmAPM($mailaddress, $ngaygiokham, $patientname, $ApmID){
        $ngay = date('Y-m-d', strtotime($ngaygiokham));
        $gio = date('H:i', strtotime($ngaygiokham));
        $current_datetime = date('Y-m-d H:i:s');
        $tieude = "VINMEC THÔNG BÁO | ".$current_datetime; ;
        $noidung = "
            <!DOCTYPE html>
                <html>
                <head>
                    <meta charset='UTF-8'>
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
                            max-width: 400px;
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
                            margin-bottom: 16px;
                            color: #1a56db;
                        }

                        .status {
                            text-align: center;
                            font-size: 18px;
                            margin-bottom: 24px;
                            padding: 12px;
                            border-radius: 6px;
                        }

                        .success {
                            background-color: #DEF7EC;
                            color: #046C4E;
                        }

                        .booking-details {
                            background-color: #F3F4F6;
                            padding: 16px;
                            border-radius: 6px;
                            margin-bottom: 24px;
                        }

                        .booking-details p {
                            margin: 8px 0;
                            color: #374151;
                        }

                        .footer {
                            color: #6b7280;
                            font-size: 14px;
                            text-align: center;
                            margin-top: 24px;
                            border-top: 1px solid #e5e7eb;
                            padding-top: 16px;
                        }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <h1 class='title'>VINMEC APPOINTMENT</h1>
                        
                        <!-- Success State -->
                        <div class='status success'>
                            Đặt lịch thành công
                        </div>

                        <div class='booking-details'>
                            <p><strong>Mã lịch hẹn:</strong> " .$ApmID."</p>
                            <p><strong>Tên bệnh nhân:</strong> " .$patientname."</p>
                            <p><strong>Ngày khám:</strong> ".$ngay."</p>
                            <p><strong>Giờ khám:</strong> ".$gio."</p>
                        </div>

                        <div class='footer'>
                            <p>Nếu bạn cần hỗ trợ, vui lòng liên hệ VINMEC qua hotline: 1900 1080</p>
                            <p>Email này được gửi tự động, vui lòng không phản hồi.</p>
                        </div>
                    </div>
                </body>
                </html>
        ";

        $result = $this->sendmail($mailaddress, $noidung, $tieude)? 0 : 1;
        if($result == 0) return true;
        else return false;  
    }

    public function RefuseApm($mailaddress, $ngaygiokham, $patientname, $ApmID){
        $ngay = date('Y-m-d', strtotime($ngaygiokham));
        $gio = date('H:i', strtotime($ngaygiokham));
        $current_datetime = date('Y-m-d H:i:s');
        $tieude = "VINMEC THÔNG BÁO | ".$current_datetime; 
        $noidung = "
            <!DOCTYPE html>
                <html>
                <head>
                    <meta charset='UTF-8'>
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
                            max-width: 400px;
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
                            margin-bottom: 16px;
                            color: #1a56db;
                        }

                        .status {
                            text-align: center;
                            font-size: 18px;
                            margin-bottom: 24px;
                            padding: 12px;
                            border-radius: 6px;
                        }

                        .failure {
                            background-color: #FDE8E8;
                            color: #C81E1E;
                        }

                        .booking-details {
                            background-color: #F3F4F6;
                            padding: 16px;
                            border-radius: 6px;
                            margin-bottom: 24px;
                        }

                        .booking-details p {
                            margin: 8px 0;
                            color: #374151;
                        }

                        .footer {
                            color: #6b7280;
                            font-size: 14px;
                            text-align: center;
                            margin-top: 24px;
                            border-top: 1px solid #e5e7eb;
                            padding-top: 16px;
                        }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <h1 class='title'>VINMEC APPOINTMENT</h1>
                        
                        <!-- Success State -->
                        <div class='status failure'>
                            Đặt lịch khám không thành công!
                        </div>

                        <div class='booking-details'>
                            <p><strong>Mã lịch hẹn:</strong> " .$ApmID."</p>
                            <p><strong>Tên bệnh nhân:</strong> " .$patientname."</p>
                            <p><strong>Ngày khám:</strong> ".$ngay."</p>
                            <p><strong>Giờ khám:</strong> ".$gio."</p>
                        </div>

                        <div class='footer'>
                            <p>Nếu bạn cần hỗ trợ, vui lòng liên hệ VINMEC qua hotline: 1900 1080</p>
                            <p>Email này được gửi tự động, vui lòng không phản hồi.</p>
                        </div>
                    </div>
                </body>
                </html>
        ";

        $result = $this->sendmail($mailaddress, $noidung, $tieude)? 0 : 1;
        if($result == 0) return true;
        else return false;
    }

}
          
?>
