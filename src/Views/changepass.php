
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/changepassstyle.css">
    <link rel="stylesheet" href="../../assets/css/styleglobal.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body{
            font-family: var(--default-font);
            background: #F5F5F5;
        }
        h2{
            text-align: center;
            margin-top: 25px;
            margin-bottom: 40px;
            color: var(--color-primary-text);
            
        }
        h3{
            text-align: center;
            margin: 10px 0 50px 0;
            color: var(--color-primary-text);
        }
        .form{
            max-width: 350px;
            margin: 0 auto;
            padding: 40px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            margin-top: 20px;
        }

        h4{
            text-align: center;
            margin: 20px 0 50px 0;
        }
        
        p {
            text-align: center;
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #555;
            line-height: 1.5;
            margin: 0;
            padding: 8px;
            border-radius: 4px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .try_again{
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .try_again button{
            background: none;
            border: none;
            color: #555;
            text-decoration: underline;
            cursor: pointer;
            font-size: 12px; /* Để giữ kích thước chữ giống các phần tử xung quanh */
            padding: 0;
        }

        .try_again button:hover{
            color:#222222;
        }

        .try_again p{
            padding: 8px 0 8px 8px;
            border: none;
            box-shadow: none;
        }

        h1{
            text-align: center;
            margin-top: 25px;
            margin-bottom: 20px;
            color: #666;
            font-size: 40px;
        }

        .change__input {
            position: relative;
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        .change__input input {

            height: 25px;
            padding: 10px 40px 10px 40px;
            /* Tạo khoảng trống cho icon bên trái */
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;

        }

        .change__input i {
            z-index: 10;
            position: absolute;
            margin-left: 10px;
            margin-top: 10px;
            font-size: 25px;
            color: #999;
        }
        .bt{
            width: 100%;
            height: 48px;
            margin: 10px 0 20px 0;
            background: #CD5B45;
            color: white; 
            font-size: 16px;
            font-weight: 450;
            text-align: center;
            align-items: center;
            border-radius: 5px;
            border: #fff;
        }
        .hidden{
            display: none !important;
        }
        .btshowpass{
            position: absolute;
            padding: 0;
            margin-top: -43px;
            margin-left: 320px;
            font-size:var(--font-size-medium);
            border: none;
            background-color: transparent;
            cursor: pointer;
        }
        .error-message {
            align-items: center;
            color: red;
            margin-top: 10px;
            display: none;
        }
        .success-message {
            align-items: center;
            color: green;
            margin-top: 10px;
            display: none;
        }
        @media (min-width: 612px) {
            .btshowpass{
                margin-left: 310px;
            }
        }
        

    </style>
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
    
    <script type="module">
        // script send mail
        const btmail = document.getElementById("enteremail");
        const email = document.getElementById("mail");

        btmail.addEventListener('click', async function(event) {
            if (email.value.trim() === "") {
                // Ngừng gửi form (ngừng hành động mặc định)
                event.preventDefault();

                // Hiển thị thông báo lỗi
                alert("Vui lòng nhập dữ liệu!");
                exit();
            } 

            //khôi phục lại các hiển thị thông báo
            document.getElementById('errorMessage1').style.display = 'none';
            
            const response = await fetch('http://localhost:3001/api/mailchangepass', {
                method: 'POST',
                headers: {
                    'Content-Type':'application/json',
                },
                body: JSON.stringify({
                    mail: email.value,
                    inputtype: 'sendmail'
                })
            });

            const data = await response.json();

            if (!data.success) {
                 // hiển thị lỗi
                 document.getElementById('errorMessage1').textContent = data.message;
                document.getElementById('errorMessage1').style.display = 'block';

            } else {
                
                document.getElementById("formcode").classList.remove("hidden");
                document.getElementById("change").classList.add("hidden");
            }
        });
        //end script send mail

        //start script code
        const code = document.getElementById("code");
        const btcode = document.getElementById("entercode");

        btcode.addEventListener('click', async function(event) {
            if(code.value.trim() === "") {
                
                event.preventDefault();

                // Hiển thị thông báo lỗi
                alert("Vui lòng nhập mã xác nhận!");
                exit();
            } else {
                //code đối chiếu mã code
                document.getElementById('errorMessage2').style.display = 'none';

                const response = await fetch('http://localhost:3001/api/checkcode', {
                    method: 'POST',
                    headers: {
                        'Content-Type':'application/json',
                    },
                    body: JSON.stringify({
                        mail: email.value,
                        code: code.value,
                        inputtype: 'checkcode'
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // Hiển thị thông báo thành công
                    document.getElementById("newpass").classList.remove("hidden");
                    document.getElementById("formcode").classList.add("hidden");
                        
                } else {
                    // hiển thị lỗi
                    document.getElementById("code").value = '';
                    document.getElementById('errorMessage2').innerText = data.message;
                    document.getElementById('errorMessage2').style.display = 'block';
                }
                    
            }
        });

        const try_again = document.getElementById("tryagain");

        try_again.addEventListener('click', (e) => {
            e.preventDefault();
            code.value = "";
            document.getElementById("formcode").classList.add("hidden");
            document.getElementById("change").classList.remove("hidden");
        });
        //end script code


        //start script update
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

        const btchange = document.getElementById("changepass");

        document.getElementById('errorMessage3').style.display = 'none';
        document.getElementById('successMessage').style.display = 'none';

        btchange.addEventListener('click', async function(event) {
            if(passField.value.trim() === '' || repassField.value.trim() === ''){
                event.preventDefault();

                // Hiển thị thông báo lỗi
                alert("Vui lòng nhập đầy đủ thông tin!");
            } else {
                if(passField.value == repassField.value) {
                    document.getElementById('errorMessage3').style.display = 'none';
                    const response = await fetch('http://localhost:3001/api/updatepass', {
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/json',
                        },
                        body: JSON.stringify({
                            mail: email.value,
                            password: passField.value,
                            inputtype: 'updatepass'
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Hiển thị thông báo thành công
                        document.getElementById('successMessage').textContent = data.message;
                        document.getElementById('successMessage').style.display = 'block';
                            
                    } else {
                        // hiển thị lỗi
                        document.getElementById('errorMessage3').textContent = data.message;
                        document.getElementById('errorMessage3').style.display = 'block';
                    }
                } else {
                    document.getElementById('errorMessage3').innerText  = 'Mật khẩu không trùng khớp! Vui lòng nhập lại';
                    document.getElementById('errorMessage3').style.display = 'block';
                }
            }
        });
        //end script update
    </script>
    
</body>
</html>