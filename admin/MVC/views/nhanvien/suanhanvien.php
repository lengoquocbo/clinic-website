<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
</head>
<style>
    .edit_container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .edit_main {
        display: flex;
        flex-direction: column;
        background-color: #f4f4f4;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    input[type="text"],
    input[type="submit"] {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        width: 100%;
    }

    input[type="submit"] {
        background-color: #218838;
        color: white;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #1e7e34;
    }
</style>

<body>

    <?php
    require_once '../model/nhanvienmodel.php';
    if (isset($_GET['id'])) {
        $staffID = $_GET['id'];
        $nhanvienmodel = new Nhanvien();
        $nhanvien = $nhanvienmodel->getById($staffID); // Fetch employee by ID
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $vitri = $_POST['vitri'];
        $sdt = $_POST['sdt'];
        $mota = $_POST['mota'];

        // $nhanvienmodel->update($staffID, $name, $vitri, $sdt, $mota);

        header('Location: nhanvien.php');
        exit();
    }
    ?>
<div class="edit_container">
    <div class="edit">
        <div class="edit_form">
            <h2>Edit Employee</h2>
            <form action="" method="POST">
                <input type="text" name="name" placeholder="Name" value="<?= $nhanvien['fullname'] ?? '' ?>">
                <input type="text" name="vitri" placeholder="Position" value="<?= $nhanvien['position'] ?? '' ?>">
                <input type="text" name="sdt" placeholder="Phone" value="<?= $nhanvien['phone'] ?? '' ?>">
                <input type="text" name="mota" placeholder="Description" value="<?= $nhanvien['description'] ?? '' ?>">
                <div class="edit_anh">

                </div>
                <input type="file" name="" id="">
                <input type="submit" value="Update">
            </form>
        </div>
    </div>
    </div>

</body>

</html>