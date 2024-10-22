<?php
    require_once __DIR__ . '/../../model/dichvumodel.php';
    if (isset($_GET['id'])) {
        $serviceid = $_GET['id'];
        $dichvumodel = new Services();
        $dichvu = $dichvumodel->getById($serviceid); // Fetch employee by ID
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $dichvu = [
            'staffID' => $_POST['staffID'],
            'servicename' => $_POST['servicename'],
            'price' => $_POST['price'],
            'description' => $_POST['description']
        ];

        if ($dichvumodel->editById($serviceid, $dichvu)) {
            echo "<script>
                alert('Cập nhật dịch vụ thành công!');
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
    <title>Edit Service</title>
    <style>
        

        .edit_container {
            margin: 0 auto;
            padding-top: 20px;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            width: 75%;
        }

        .edit_main {
            
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .edit_main h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2d3436;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #636e72;
        }
        textarea,
        input[type="text"],
        input[type="number"] {
            width: 97%;
            padding: 12px;
            margin: 0 auto;
            margin-bottom: 15px;
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            border: 1px solid #dfe6e9;
            border-radius: 8px;
            background-color: #f1f2f6;
            transition: border 0.3s ease;
        }
        textarea{
            min-height: 100px;
            
        }
        
        input[type="text"]:focus,
        input[type="number"]:focus {
            border: 1px solid #74b9ff;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        

        input[type="submit"]:hover {
            background-color: darkgreen;
        }
    </style>
</head>

<body>
    <div class="edit_container">
        <div class="edit_main">
            <h2>Edit Service</h2>
            <form action="" method="POST">
                <label for="staffID">Mã nhân viên phụ trách</label>
                <input type="text" name="staffID" id="staffID" required value="<?= $dichvu['staffID']; ?>">

                <label for="servicename">Tên dịch vụ</label>
                <input type="text" name="servicename" id="servicename" required value="<?= $dichvu['servicename']; ?>">

                <label for="price">Giá dịch vụ</label>
                <input type="text" name="price" id="price" required value="<?= number_format($dichvu['price'], 0, ',', '.') ?> VNĐ">

                <label for="description">Mô tả dịch vụ</label>
                <textarea type="text" id="description" required name="description" ><?= $dichvu['description']; ?></textarea>

                <input type="submit" value="Cập nhật">
            </form>
        </div>
    </div>
</body>

</html>