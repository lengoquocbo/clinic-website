<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="../../../assets/css/registerstyle.css">
    <link rel="stylesheet" href="../../../assets/css/styleglobal.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="register">
        <h1 class="reg_title">Vinmeclatest</h1>
        <p>Đăng ký tài khoản</p>
        <form action="" method="POST">
            <div class="reg_input">
                <i class='bx bx-phone' ></i>
                <input type="text" id="reg_phone" name="phone" placeholder="Số điện thoại của bạn" required>
            </div>
            <div class="reg_input">
                <i class='bx bx-user'></i>
                <input type="text" id="reg_usname" name="usname" placeholder="Nhập tên người dùng" required>
            </div>
            <div class="reg_input">
                <i class='bx bx-lock-alt' ></i>
                <input type="text" id="reg_password" name="password" placeholder="Khởi tạo mật khẩu" required>
            </div>
                <button class="reg_btshowpass" id="showpassword">
                <i class="bx bx-hide" id="passwordIcon"></i>
            </button>
            <div class="reg_input">
                <i class='bx bx-lock-alt' ></i>
                <input type="text" id="reg_repassword" name="repassword" placeholder="Nhập lại mật khẩu" required>
            </div>

            <script>
                const passField = document.getElementById("reg_password");
                const repassField = document.getElementById("reg_repassword")
                const showBtn = document.getElementById("showpassword");
                const passwordIcon = document.getElementById("passwordIcon");

                showBtn.addEventListener('click', (e) => {
                    e.preventDefault();  // Ngăn chặn sự kiện submit form khi nhấn nút hiển thị mật khẩu

                    if (passField.type === "password") {
                        passField.type = "text";
                        repassField.type = "text";
                        passwordIcon.classList.replace("bx-hide", "bx-show");
                    } else {
                        passField.type = "password";
                        repassField.type = "password";
                        passwordIcon.classList.replace("bx-show", "bx-hide");
                    }
                });
            </script>

            <div class="reg_checkbox">
                <label>
                    <input type="checkbox" name="remember"> Nhớ mật khẩu
                </label>
            </div>
            <button type="submit" class="btreg">Đăng Ký</button>

            <div class="reg_span">
                <span>OR</span>
            </div>
            
            <div class="otherreg">
                <a href="#"><i class='bx bxl-apple' style="color: black;"></i></a>
                <a href="#"><i class="bx bxl-facebook-circle"></i></a>
                <a href="#"><i class="bx bxl-google"></i></a>
            </div>
        </form>
    </div>
</body>
</html>