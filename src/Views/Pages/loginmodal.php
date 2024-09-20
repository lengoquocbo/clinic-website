<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../../../assets/css/loginmodalstyle.css">
    <link rel="stylesheet" href="../../../assets/css/styleglobal.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <button id="openModalButton" class="openModalButton">Đăng Nhập</button>


    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="login">
                <h1 class="login__title">Vinmeclatest</h1>
                <p>Đăng nhập để tiếp tục</p>


                <?php if (!empty($error_message)) : ?>
                <p style="color: red;">
                    <?php echo $error_message; ?>
                </p>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="login__input">
                        <i class="bx bx-user"></i>
                        <input type="text" id="email" name="email" placeholder="Email/ Số điện thoại của bạn" required>
                    </div>
                    <div class="login__input">
                        <i class="bx bx-lock-alt"></i>
                        <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
                    </div>
                    <button class="login__icon-button" id="showpassword">
                        <i class="bx bx-hide" id="passwordIcon"></i>
                    </button>

                    <script>
                        const passField = document.getElementById("password");
                        const showBtn = document.getElementById("showpassword");
                        const passwordIcon = document.getElementById("passwordIcon");

                        showBtn.addEventListener('click', (e) => {
                            e.preventDefault();  // Ngăn chặn sự kiện submit form khi nhấn nút hiển thị mật khẩu

                            if (passField.type === "password") {
                                passField.type = "text";
                                passwordIcon.classList.replace("bx-hide", "bx-show");
                            } else {
                                passField.type = "password";
                                passwordIcon.classList.replace("bx-show", "bx-hide");
                            }
                        });

                    </script>

                    <div class="login__checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Nhớ mật khẩu
                        </label>
                        <a href="#">Quên mật khẩu?</a>
                    </div>
                    <button type="submit" class="btnlogin">Đăng Nhập</button>
                </form>

              
                <div class="login__divide"><span>OR</span></div>
                <div class="login__methodlogin">
                    <a href="#"><i class='bx bxl-apple' style="color: black;"></i></a>
                    <a href="#"><i class="bx bxl-facebook-circle"></i></a>
                    <a href="#"><i class="bx bxl-google"></i></a>
                </div>

               
                <div class="login__register">
                    <p>Bạn chưa có tài khoản? <a href="/register"><b>Đăng ký</b></a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        
        const modal = document.getElementById("loginModal");
        const openModalButton = document.getElementById("openModalButton");
        const closeModal = document.getElementsByClassName("close")[0];

        openModalButton.onclick = function () {
            modal.style.display = "block";
        }

        closeModal.onclick = function () {
            modal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>