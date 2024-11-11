<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../../assets/css/loginstyle.css">
    <link rel="stylesheet" href="../../assets/css/styleglobal.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
</head>

<body>
    <div class="login">
        <h1 class="login__title">Vinmeclatest</h1>
        <p>Đăng nhập để tiếp tục</p>
        <form  id="loginForm">
            <div class="login__input">
                <i class="bx bx-user"></i>
                <input type="text" id="phone" name="phone" placeholder="Số điện thoại của bạn" required>
            </div>
            <div class="login__input">
                <i class="bx bx-lock-alt"></i>
                <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
            </div>
            <button class="login__icon-button" id="showpassword">
                <i class="bx bx-hide" id="passwordIcon"></i>
            </button>
            <div class="login__checkbox">
                <label>
                    <input type="checkbox" name="remember" id="remember"> Nhớ mật khẩu
                </label>
                <a href="#">Quên mật khẩu?</a>
            </div>
            <button type="submit" class="btnlogin" id="submit">Đăng Nhập</button>
        </form>
        <div class="login__divide">
            <span>OR</span>
        </div>

        <div class="login__methodlogin">
            <a href="#"><i class='bx bxl-apple' style="color: black;"></i></a>
            <a href="#"><i class="bx bxl-facebook-circle"></i></a>
            <a href="#"><i class="bx bxl-google"></i></a>
        </div>

        <div class="login__register">
            <p>Bạn chưa có tài khoản? <a href="register.php"><b>Đăng ký</b></a></p>
        </div>
        <div id="errorMessage" class="error-message"></div>
        <div id="successMessage" class="success-message"></div>
    </div>
    <script src="/assets/js/login.js"></script>
</body>
</html>
