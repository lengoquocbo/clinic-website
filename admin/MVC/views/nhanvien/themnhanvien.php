<?php
require_once 'C:\xampp\htdocs\clinic-website\admin\MVC\model\nhanvienmodel.php ';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nhanvien = new Nhanvien();

    $data = [
        'staffID' => $_POST['staffID'],
        'fullname' => $_POST['fullname'],
        'position' => $_POST['position'],
        'phone' => $_POST['phone'],
        'status' => $_POST['status']
    ];

    // Xử lý upload ảnh (nếu có)
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $target_dir = "uploads/";  // Tạo thư mục này nếu chưa có
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            $data['image'] = $target_file;  // Thêm đường dẫn ảnh vào data nếu cần
        }
    }

    if ($nhanvien->addStaff($data)) {
        echo "Thêm nhân viên thành công!";
    } else {
        echo "Có lỗi xảy ra khi thêm nhân viên.";
    }
} else {
    echo "Không có dữ liệu được gửi đến.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhân Viên Mới</title>
    <link rel="stylesheet" href="../../../../assets/css/styleglobal.css">
    <style>
        body {
            font-family: var(--default-font);
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form_add {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            display: flex;
        }

        .form_add_img,
        .form_add_info {
            flex: 1;
            padding: 15px;
        }

        .form_add_img {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .image-preview {
            width: 200px;
            height: 300px;
            border: 2px dashed #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            display: none;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #666;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        select,
        textarea {
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        input[type="submit"],
        input[type="file"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover,
        input[type="file"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="form_container_around">
        <div class="form_container">
            <div class="form_add">
                <div class="form_add_img">
                    <div class="image-preview">
                        <img id="preview" src="#" alt="Preview">
                    </div>
                    <input type="file" name="img" id="img" accept="image/*">
                </div>
                <div class="form_add_info">
                    <h2>Thêm Nhân Viên Mới</h2>
                    <form action="#" method="POST">
                        <label for="fullname">Họ và tên:</label>
                        <input type="text" id="fullname" name="fullname" required>

                        <label for="position">Chức vụ:</label>
                        <input type="text" id="position" name="position" required>

                        <label for="phone">Số điện thoại:</label>
                        <input type="tel" id="phone" name="phone" required>

                        <label for="mota">Mô tả:</label>
                        <textarea name="mota" id="mota"></textarea>

                        <input type="submit" value="Thêm Nhân Viên">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- <script>
        document.getElementById('img').onchange = function(evt) {
            var tgt = evt.target || window.event.srcElement,
                files = tgt.files;

            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = function() {
                    document.getElementById('preview').src = fr.result;
                    document.getElementById('preview').style.display = 'block';
                }
                fr.readAsDataURL(files[0]);
            }
        }
    </script> -->
</body>

</html>