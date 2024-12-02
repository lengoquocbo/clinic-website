<?php
require_once __DIR__ . '../../../model/nguoidungmodel.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nguoidung = new Nguoidung();

    // Lấy dữ liệu từ form và xử lý
    $data = [
        'username' => htmlspecialchars(trim($_POST['username'])),
        'phone' => htmlspecialchars(trim($_POST['phone'])),
        'mail' => filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL),
        'pass' => password_hash($_POST['pass'], PASSWORD_BCRYPT), // Hash mật khẩu
        'role' => intval($_POST['role']),
    ];

    // Kiểm tra role hợp lệ
    $valid_roles = [1, 2, 3]; // Các vai trò: 1=Admin, 2=Manager, 3=Staff
    if (!in_array($data['role'], $valid_roles)) {
        echo "<script>alert('Vai trò không hợp lệ'); location.href='index.php?mod=nhanvien&act=list';</script>";
        exit;
    }

    // Gọi hàm thêm nhân viên
    if ($nguoidung->adduser($data)) {
        echo "<script>alert('Thêm Người Dùng Thành Công'); location.href='index.php?mod=nguoidung&act=list';</script>";
    } else {
        echo "<script>alert('Thêm Người Dùng Không Thành Công'); location.href='index.php?mod=nguoidung&act=list';</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhân Viên</title>
    <link rel="stylesheet" href="../../../../assets/css/styleglobal.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .form_container_around {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
            width: 50%;
        }

        .form_container {
            width: 90%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            color: #666;
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="tel"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="form_container_around">
        <div class="form_container">
            <h2>Thêm Nhân Viên</h2>
            <form action="" method="POST">
            <label for="role">Vai trò:</label>
                <select name="role" id="role" required>
                    <option value="" disabled selected>Chọn vai trò</option>
                    <option value="1">User</option>
                    <option value="2">Staff</option>
                    <option value="3">Admin</option>
                </select>
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>

                <label for="mail">Email:</label>
                <input type="text" id="mail" name="mail" placeholder="Nhập email" required>

                <label for="phone">Số điện thoại:</label>
                <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" required>

                <label for="pass">Mật khẩu:</label>
                <input type="text" id="pass" name="pass" placeholder="Nhập mật khẩu" required>

              

                <input type="submit" value="Thêm Nhân Viên">
            </form>
        </div>
    </div>
</body>

</html>
