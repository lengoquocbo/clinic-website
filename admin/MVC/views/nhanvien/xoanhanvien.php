<?php
require_once __DIR__ . '/../../model/nhanvienmodel.php';

if (isset($_GET['id'])) {
    $staffID = $_GET['id'];
    $nhanvien = new Nhanvien();
    
    // Thực hiện xóa nhân viên
    if ($nhanvien->delete_staff($staffID)) {
        echo "<script>
                alert('Xóa nhân viên thành công!');
                window.location.href = 'index.php?mod=nhanvien&act=list';
              </script>";
        exit;
    } else {
        // Nếu có lỗi khi xóa
        echo "<script>
                alert('Lỗi khi xóa nhân viên. Vui lòng thử lại.');
                window.history.back();
              </script>";
    }
} else {
    // Nếu không có ID, quay lại danh sách nhân viên
    echo "<script>
            alert('Không tìm thấy nhân viên để xóa.');
            window.location.href = 'index.php?mod=nhanvien&act=list';
          </script>";
}
?>
