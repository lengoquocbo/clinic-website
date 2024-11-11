
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../assets/css/changepassstyle.css">
        <link rel="stylesheet" href="../../assets/css/styleglobal.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        
    
    </head>
    <body>
        <h1>VINMECLASTEST</h1>
        <h3>ĐỔI MẬT KHẨU</h3>
        <div class="form phone" id="change">
            <h2>NHẬP EMAIL</h2>
            <div class="change__input">
                <i class='bx bx-envelope'></i>
                <input type="mail" placeholder="Nhập email của bạn" id="mail" required>
            </div>
            <div id="errorMessage1" class="error-message"></div>
            <button type="submit" class="bt" id="enteremail">Tiếp tục với email này</button>
            <p>By continuing, you agree to Vinmeclatest’s Consumer Terms and Usage Policy, and acknowledge their Privacy Policy.</p>
        </div>

        <!-- form nhap code -->
        <div class="form entercode hidden" id="formcode">
            <h2>NHẬP MÃ XÁC NHẬN</h2>
            <div class="change__input">
                <input type="text" placeholder="Nhập mã xác nhận đã gửi" id="code" required autocomplete="off" style="text-align: center;">
            </div>
            <div id="errorMessage2" class="error-message"></div>
            <button class="bt" id="entercode">Xác nhận địa chỉ email</button>
            <div class="try_again">
                <p>Không nhận được mail trong hòm thư của bạn?</p>
                <button id="tryagain">Thử gửi lại</button>
            </div>
        </div>
    
        <!-- form doi mat khau -->
        <div class="form enternewpass hidden" id="newpass">
            <h2>CHÚC MỪNG!!!<br>HÃY TẠO MẬT KHẨU MỚI VÀ ĐỪNG CÓ QUÊN NỮA NHÉ!</h2>
            <div class="change__input">
                <i class='bx bx-lock-alt' ></i>
                <input type="password" id="password" placeholder="Khởi tạo mật khẩu" required>
            </div>
            <button class="btshowpass" id="showpassword">
                <i class="bx bx-hide" id="passwordIcon"></i>
            </button>
            <div class="change__input">
                <i class='bx bx-lock-alt' ></i>
                <input type="password" id="repassword" placeholder="Nhập lại mật khẩu" required>
            </div>
            <div id="errorMessage3" class="error-message"></div>
            <div id="successMessage" class="success-message"></div>
            <button class="bt" id="changepass">Xác nhận mật khẩu mới</button>

        </div>
        
    </body>
    <script src="../../assets/js/changepass.js"></script>
</html>
