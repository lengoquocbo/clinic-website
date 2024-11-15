
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
</head>
<style>
    .edit {
        display: flex;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 60px;
        width:100%;
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

    input[type="text"],
    input[type="submit"] {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        width: 98%;
        height: 30px;
        font-size: 16px;
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
require_once '../model/nhanvienmodel.php';  // Đảm bảo bạn đã require đúng model

if (isset($_GET['id'])) {
    $staffID = $_GET['id'];
    $nhanvienmodel = new Nhanvien();
    $nhanvien = $nhanvienmodel->getById($staffID); // Lấy thông tin nhân viên từ database
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $vitri = $_POST['vitri'];
    $sdt = $_POST['sdt'];
    $mota = $_POST['mota'];

    // Kiểm tra xem có ảnh được tải lên không
    if (isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
        $targetDir = '../views/nhanvien/uploads/';
        $fileName = basename($_FILES['anh']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Kiểm tra loại file (chỉ chấp nhận các file ảnh)
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file ảnh lên server
            if (move_uploaded_file($_FILES['anh']['tmp_name'], $targetFilePath)) {
                // Lưu tên file ảnh vào cơ sở dữ liệu
                $hinhanh = $fileName;
            } else {
                echo "Có lỗi xảy ra khi tải file.";
            }
        } else {
            echo "Chỉ chấp nhận các file ảnh có định dạng JPG, JPEG, PNG, GIF.";
        }
    } else {
        // Nếu không có ảnh mới được tải lên, giữ nguyên ảnh cũ
        $hinhanh = $nhanvien['hinhanh'];
    }

    // Cập nhật nhân viên vào cơ sở dữ liệu
    $nhanvienmodel->editStaff($staffID, [
        'fullname' => $name,
        'position' => $vitri,
        'phone' => $sdt,
        'status' => $mota,
        'hinhanh' => $hinhanh
    ]);

    // Chuyển hướng sau khi cập nhật thành công
    header('Location: index.php?mod=nhanvien&act=list');
    exit();
}
?>
<div class="edit_container">
    <div class="edit">
        <div class="edit_form">
            <h2>Edit Employee</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Name" value="<?= htmlspecialchars($nhanvien['fullname'] ?? '') ?>">
                <input type="text" name="vitri" placeholder="Position" value="<?= htmlspecialchars($nhanvien['position'] ?? '') ?>">
                <input type="text" name="sdt" placeholder="Phone" value="<?= htmlspecialchars($nhanvien['phone'] ?? '') ?>">
                <input type="text" name="mota" placeholder="Description" value="<?= htmlspecialchars($nhanvien['status'] ?? '') ?>">
                
                <div class="edit_anh">
                <img src="../views/nhanvien/uploads/<?= htmlspecialchars($nhanvien['hinhanh']) ?>" alt="Hình ảnh nhân viên" style="width: 100px; height: auto;">
                <img id="preview" src="#" alt="Preview" style="width: 100px;">
                </div>
                
                <input type="file" name="anh" id="anh">
                <input style="margin-top: 20px;" type="submit" value="Update">
            </form>
            
        <script>
        document.getElementById('anh').onchange = function(evt) {
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
        </div>
    </div>
</div>

</body>

</html>
