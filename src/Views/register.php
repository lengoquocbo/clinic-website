<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="../../assets/css/registerstyle.css">
    <link rel="stylesheet" href="../../assets/css/styleglobal.css">
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
                <input type="text" id="phone" placeholder="Nhập số điện thoại" required>
            </div>
            <div class="reg_input">
                <i class='bx bx-envelope'></i>
                <input type="mail"  id="mail" placeholder="Nhập địa chỉ email" required>
            </div>
            <div class="reg_input">
                <i class='bx bx-user'></i>
                <input type="text" id="usrname" placeholder="Nhập tên người dùng" required>
            </div>
            
            <div class="reg_input">
                <i class='bx bx-lock-alt' ></i>
                <input type="password" id="password" placeholder="Khởi tạo mật khẩu" required>
            </div>
                <button class="reg_btshowpass" id="showpassword">
                <i class="bx bx-hide" id="passwordIcon"></i>
            </button>
            <div class="reg_input">
                <i class='bx bx-lock-alt' ></i>
                <input type="password" id="repassword" placeholder="Nhập lại mật khẩu" required>
            </div>

            <script>
                const passField = document.getElementById("password");
                const repassField = document.getElementById("repassword")
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
                    <input type="checkbox" id="remember"> Nhớ mật khẩu
                </label>
            </div>
            <button type="submit" class="btreg" id="submit">Đăng Ký</button>

            <div class="reg_span">
                <span>OR</span>
            </div>
            
            <div class="otherreg">
                <a href="#"><i class='bx bxl-apple' style="color: black;"></i></a>
                <a href="#"><i class="bx bxl-facebook-circle"></i></a>
                <a href="#"><i class="bx bxl-google"></i></a>
            </div>
            <div id="errorMessage" class="error-message"></div>
            <div id="successMessage" class="success-message"></div>
        </form>
    </div>
    <script>
        const submit = document.getElementById('submit');
        submit.addEventListener('click', async (e)=>{
            e.preventDefault();

            //khôi phục lại các hiển thị thông báo
            document.getElementById('errorMessage').style.display = 'none';
            document.getElementById('successMessage').style.display = 'none';

            const phone = document.getElementById('phone').value;
            const name = document.getElementById('usrname').value;
            const mail = document.getElementById('mail').value;
            const password = document.getElementById('password').value;
            const repassword = document.getElementById('repassword').value;
            const remember = document.getElementById('remember').vlaue;
            
            console.log(phone, name, mail, password);
            

            //xử lý checkbox để xem thử có lưu vào cookie hay không
            // const remember = document.getElementById('remember');
            // const result = checkbox.checked ? 'True' : 'False';

            if(repassword == password) {
                const requestdata = {
                    phone: phone,
                    name: name,
                    mail: mail,
                    pass: password
                }
                try { 
                    const response = await fetch('http://localhost:3001/api/register', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/json',
                        },
                        body: JSON.stringify(requestdata)
                    });

                    const data = await response.json();
                    
                    if (data.success) {
                        // Hiển thị thông báo thành công
                        document.getElementById('successMessage').textContent = data.message;
                        document.getElementById('successMessage').style.display = 'block';
                            
                        // Redirect sau 1 giây
                        setTimeout(() => {
                            window.location.href = 'index.php'; // Thay đổi URL theo nhu cầu
                        }, 1000);
                    } else {
                        // hiển thị lỗi
                        document.getElementById('errorMessage').textContent = data.message;
                        document.getElementById('errorMessage').style.display = 'block';
                    }
                } catch(error) {
                    console.error('Error:', error);
                    document.getElementById('errorMessage').textContent = 'Đã xảy ra lỗi khi đăng ký';
                    document.getElementById('errorMessage').style.display = 'block';
                }
            } else {
                //
            }
        });    
    </script>
</body>
</html>