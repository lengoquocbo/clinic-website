<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quản Lý Tài Khoản</title>
    <style>
        
        .acc_container{
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .accout-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px;
            min-width: 350px;
            max-width: 500px;
            width: 100%;
            position: relative;

        }
        .around {
            display: flex;
            flex-direction: column;
        }
        .accout-information, .accout-changepass {
            margin-bottom: 20px;
            width: 100%;
            margin-bottom: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
        h3 {
            color: #333;
            padding-bottom: 10px;
        }
        input {
            width: 100%;
            padding: 12px 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .error {
            color: red;
            font-size: 0.8em;
            margin-top: -5px;
        }
        .success {
            color: green;
            font-size: 0.8em;
            margin-top: -5px;
        }
        .btn{
            background-color: #4CAF50;
            height: 40px;
            border: none;
            border-radius: 4px;
            color: #f4f4f4;
            margin: 10px 0;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .back-btn {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 14px;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }
        .hidden{
            display: none;
        }
    </style>
</head>
<body>
    <div class="acc_container">
        <div class="accout-container" id="profile">
            <div class="around">
                <h3>Thông Tin Cá Nhân : <?php echo $userdata['username']; ?></h3>
                <div class="accout-information">
                    <input type="text" id="phone" value = "<?php echo $userdata['phone']; ?>" placeholder = "<?php echo $userdata['phone']; ?>">
                    <input type="text" id="email" placeholder="<?php echo $userdata['mail']; ?>" value="<?php echo $userdata['mail']; ?>">
                    <button class="btn" id="update">Cập Nhật</button><br>
                    <button class="btn" style="background-color: #007BFF;" id="tochange">Đổi mật khẩu</button>
                </div>
            </div>
        </div>

        <div class="accout-container hidden" id="change">
            <h3>Đổi Mật Khẩu</h3>
            <div class="accout-changepass">
                <input type="password" id="oldPassword" placeholder="Nhập mật khẩu cũ">
                <input type="password" id="newPassword" placeholder="Nhập mật khẩu mới">
                <input type="password" id="confirmPassword" placeholder="Xác nhận mật khẩu">
                <button class="btn" style="background-color: #007BFF;" id="changepass">Đổi Mật Khẩu</button>
                <button class="back-btn" onclick="goBack()">Quay lại</button>

            </div>
        </div>
    </div>

    <script src="assets/js/Account.js"></script>
    <script>
        function goBack() {
            // Chuyển hướng về trang trước đó
            location.reload();
        }
    </script>

</body>
</html>