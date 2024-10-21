<?php
require_once __DIR__ . '/../../model/dichvumodel.php';
if (isset($_GET['id'])) {
    $serviceID = $_GET['id'];
    $dichvu = new Services();
    
    if ($dichvu->delete_service($serviceID)) {
        echo "<script>
                alert('Thêm dịch vụ thành công!');
                window.location.href = 'index.php?mod=dichvu&act=list';
              </script>";
        exit;
    } else {
        echo
             "<script> alert('Lỗi khi cập nhật: " . $this->db->error . "'); window.history.back(); </script>";
    }
}
?>