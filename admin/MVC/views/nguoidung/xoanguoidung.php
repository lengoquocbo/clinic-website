<?php
// Yêu cầu tệp chứa class Medicine
require_once 'C:\xampp\htdocs\clinic-website\admin\MVC\model\nguoidungmodel.php';

$userID = $_GET['id']; // Lấy medicineID từ tham số GET
$nguoidung = new Nguoidung();

if ($nguoidung->delete_user($userID)) {
    echo "<script>alert('Xóa Thành Công'); location.href='index.php?mod=nguoidung&act=list';</script>";
    exit();
} else {
    echo "<script>alert('Lỗi Khi Xóa'); location.href='index.php?mod=nguoidung&act=list';</script>";
}
?>
