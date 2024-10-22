<?php
require_once __DIR__ . '/../../model/dichvumodel.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dichvu = new Services();

    $data = [
        'staffID' => $_POST['staffID'],
        'servicename' => $_POST['servicename'],
        'price' => $_POST['price'],
        'description' => $_POST['description']
    ];

    
    if ($dichvu->addservice($data)) {
        echo "<script>
                alert('Thêm dịch vụ thành công!');
                window.location.href = 'index.php?mod=dichvu&act=list';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Lỗi khi cập nhật: " . $this->db->error . "');
                window.history.back();
              </script>";
    }
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm dịch vụ Mới</title>
    <link rel="stylesheet" href="../../../../assets/css/styleglobal.css">
    <style>
        .form_container_around{
            font-family: var(--default-font);
            
            box-shadow: #ddd;
            padding: 20px;
            width: 75% !important;
            
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            margin-top: 20px;
            
        } 
        .form_add {
            background-color: white;
            padding: 30px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
 
        }

        .form_add_info {
            flex: 1;
            padding: 15px;
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
        input[type="number"],
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
                <div class="form_add_info">
                    <h2>Thêm dịch vụ mới</h2>
                    <form action="#" method="POST">
                        <label for="staffID">Mã Nhân viên phụ trách:</label>
                        <input type="number" id="staffID" name="staffID" required>

                        <label for="servicename">Tên dịch vụ</label>
                        <input type="text" id="servicename" name="servicename" required>

                        <label for="price">Giá:</label>
                        <input type="number" id="price" name="price" required>

                        <label for="description">Mô tả:</label>
                        <textarea type="text" id="description" name="description"></textarea>

                        <input type="submit" value="Thêm dịch vụ">
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
    
</body>

</html>