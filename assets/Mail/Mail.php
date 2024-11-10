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
            return 'success';
        } catch (Exception $e) {
            echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
            return 'failed';
        }

    }

    function createcode(){
        return str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }
}
          
?>
