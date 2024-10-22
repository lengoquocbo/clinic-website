<?php
require_once 'C:\xampp\htdocs\clinic-website\admin\MVC\model\thuocmodel.php';
require_once 'C:\xampp\htdocs\clinic-website\admin\MVC\model\dichvumodel.php';

// Khởi tạo model và lấy danh sách dịch vụ
$serviceModel = new Services();
$services = $serviceModel->getname();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicine = new Medicine();

    $data = [
        'serviceID' => $_POST['serviceID'],
        'name' => $_POST['name'],
        'function' => $_POST['function'],
        'price' => $_POST['price'],
        'status' => $_POST['status'],
    ];

    if ($medicine->addMedicine($data)) {
        echo "<script>alert('Thêm Thuốc Thành Công'); location.href='index.php?mod=thuoc&act=list';</script>";
    } else {
        echo "<script>alert('Thêm Thuốc Không Thành Công'); location.href='index.php?mod=thuoc&act=list';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Thuốc Mới</title>
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

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #666;
            font-weight: bold;
        }

        select,
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
                <h2>Thêm Thuốc Mới</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="serviceID">Dịch Vụ:</label>
                    <select id="serviceID" name="serviceID" required>
                        <option value="">Chọn dịch vụ</option>
                        <?php foreach ($services as $service): ?>
                            <option value="<?php echo $service['serviceID']; ?>"><?php echo $service['servicename']; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="name">Tên Thuốc:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="function">Chức Năng:</label>
                    <input type="text" id="function" name="function" required>

                    <label for="price">Giá:</label>
                    <input type="text" id="price" name="price" required>

                    <label for="status">Trạng Thái:</label>
                    <input type="text" id="status" name="status" required>

                    <input type="submit" value="Thêm Thuốc">
                </form>
            </div>
        </div>
    </div>
</body>

</html>