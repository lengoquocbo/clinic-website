<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Medicine</title>
    <style>
        .edit {
            display: flex;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 60px;
            width: 100%;
            border-radius: 8px;
        }

        .edit_form {
            display: flex;
            flex-direction: column;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        select,
        input[type="text"],
        input[type="submit"] {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 98%;
            outline: none;
        }

        input[type="submit"] {
            background-color: #218838;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #1e7e34;
        }

        label {
            font-size: 20px;
            font-weight: 500;
            color: var(--color-default);
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <?php
    require_once 'C:\xampp\htdocs\clinic-website\admin\MVC\model\thuocmodel.php';
    require_once 'C:\xampp\htdocs\clinic-website\admin\MVC\model\dichvumodel.php'; // Thêm phần lấy danh sách dịch vụ

    if (isset($_GET['id'])) {
        $medicineID = $_GET['id'];
        $thuocmodel = new Medicine();
        $thuoc = $thuocmodel->getById($medicineID);

        $serviceModel = new Services();
        $services = $serviceModel->getAll(); // Lấy tất cả dịch vụ
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
            'serviceID' => $_POST['serviceID'],
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'function' => $_POST['function'],
            'status' => $_POST['status'],
        ];

        // Cập nhật thông tin thuốc với serviceID
        if ($thuocmodel->edit_medicine($medicineID, $data)) {
            echo "<script>alert('Cập Nhật Thành Công'); location.href='index.php?mod=thuoc&act=list';</script>";

        } else {
            echo "<script>alert('Cập Nhật Thất Bại'); location.href='index.php?mod=thuoc&act=list';</script>";
        }
    }
    ?>

    <div class="edit_container">
        <div class="edit">
            <div class="edit_form">
                <h2>Edit Medicine</h2>
                <form action="" method="POST">
                    <label for="serviceID">Dịch Vụ:</label>
                    <select id="serviceID" name="serviceID" required>
                        <option value="">Chọn dịch vụ</option>
                        <?php foreach ($services as $service): ?>
                            <option value="<?php echo $service['serviceID']; ?>" <?php if ($service['serviceID'] == $thuoc['serviceID']) echo 'selected'; ?>>
                                <?php echo $service['servicename']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="name">Tên thuốc:</label>
                    <input type="text" name="name" placeholder="Tên thuốc" value="<?= $thuoc['name'] ?? '' ?>" required>

                    <label for="price">Giá:</label>
                    <input type="text" name="price" placeholder="Giá" value="<?= $thuoc['price'] ?? '' ?>" required>

                    <label for="function">Chức năng:</label>
                    <input type="text" name="function" placeholder="Chức năng" value="<?= $thuoc['function'] ?? '' ?>" required>

                    <label for="status">Trạng thái:</label>
                    <input type="text" name="status" placeholder="Trạng thái" value="<?= $thuoc['status'] ?? '' ?>" required>

                    <input type="submit" value="Cập Nhật">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
