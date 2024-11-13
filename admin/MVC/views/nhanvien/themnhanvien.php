<?php
require_once __DIR__ .'../../../model/nhanvienmodel.php';

function generateRandomString($fullName) {
    $nameParts = explode(' ', $fullName);
    $lastName = end($nameParts);
    $shortName = substr($lastName, 0, 3);
    $randomNumbers = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
    return $shortName . $randomNumbers;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nhanvien = new Nhanvien();

    // Tạo staffID ngẫu nhiên từ fullname
    $staffID = generateRandomString($_POST['fullname']);

    $data = [
        'staffID' => $staffID, // Dùng staffID ngẫu nhiên đã tạo
        'fullname' => $_POST['fullname'],
        'position' => $_POST['position'],
        'phone' => $_POST['phone'],
        'status' => $_POST['status'],
    ];

    // Xử lý upload hình ảnh
    if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == 0) {
        $targetDir = '../views/nhanvien/uploads/';
        $fileName = basename($_FILES['hinhanh']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Kiểm tra loại file (chỉ chấp nhận các file ảnh)
        $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
        if (in_array($fileType, $allowTypes)) {
            // Upload file ảnh lên server
            if (move_uploaded_file($_FILES['hinhanh']['tmp_name'], $targetFilePath)) {
                // Lưu tên file ảnh vào cơ sở dữ liệu
                $data['hinhanh'] = $fileName; // Thêm tên file ảnh vào mảng dữ liệu
            } else {
                echo "<script>alert('Có lỗi xảy ra khi tải file.');</script>";
            }
        } else {
            echo "<script>alert('Chỉ chấp nhận các file ảnh có định dạng JPG, JPEG, PNG, GIF.');</script>";
        }
    } else {
        $data['hinhanh'] = null; // Không có ảnh được tải lên
    }

    if ($nhanvien->addStaff($data)) {
        echo "<script>alert('Thêm Nhân Viên Thành Công'); location.href='index.php?mod=nhanvien&act=list';</script>";
    } else {
        echo "<script>alert('Thêm Nhân Viên Không Thành Công'); location.href='index.php?mod=nhanvien&act=list';</script>";
    }
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
        .search-form {
            display: inline-block;
        }

        .form_container_around {
            display: flex;
            width: 70%;
        }

        .form_container {
            width: 100%;
            display: flex;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 60px;
        }

        .form_add_img,
        .form_add_info {
            flex: 1;
            padding: 15px;
            box-sizing: border-box;
        }

        .form_add_img {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            max-width: 300px;
            margin-right: 40px;
        }

        .image-preview {
            width: 200px;
            height: 250px;
            border: 2px dashed #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
            background-color: #fafafa;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            display: none;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .form {
            display: flex;
            flex-direction: row;
        }

        label {
            margin-bottom: 5px;
            color: #666;
            font-weight: bold;
        }


        input[type="text"],
        input[type="tel"],
        textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
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
            margin-top: 10px;
        }

        input[type="submit"]:hover,
        input[type="file"]:hover {
            background-color: #45a049;
        }

        /* CSS cho màn hình nhỏ hơn */
        @media (max-width: 768px) {
            .form_container {
                flex-direction: column;
            }

            .form_add_img {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="form_container_around">
        <div class="form_container">
            <div class="form_add_info">
                <h2>Thêm Nhân Viên Mới</h2>
                <form class="form" action="" method="POST" enctype="multipart/form-data">
                    <div class="form_add_img">
                        <div class="image-preview">
                            <img id="preview" src="#" alt="Preview">
                        </div>
                        <input type="file" name="hinhanh" id="hinhanh" accept="image/*">
                    </div>
                    <div>
                        <label for="fullname">Họ và tên:</label>
                        <input type="text" id="fullname" name="fullname" required>

                        <label for="position">Chức vụ:</label>
                        <input type="text" id="position" name="position" required>

                        <label for="phone">Số điện thoại:</label>
                        <input type="tel" id="phone" name="phone" required>

                        <label for="status">Mô tả:</label>
                        <textarea name="status" id="status"></textarea>

                        <input type="submit" value="Thêm Nhân Viên">
                </form>
            </div>
        </div>
    </div>
    </div>

   
        <script>
        document.getElementById('hinhanh').onchange = function(evt) {
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
    </script> 
    
</body>

</html>