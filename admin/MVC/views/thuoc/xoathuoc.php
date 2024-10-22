<?php
// Yêu cầu tệp chứa class Medicine
require_once 'C:\xampp\htdocs\clinic-website\admin\MVC\model\thuocmodel.php';

$medicineID = $_GET['id']; // Lấy medicineID từ tham số GET
$thuocmodel = new Medicine();

if ($thuocmodel->delete_medicine($medicineID)) {
    echo "<script>alert('Xóa Thành Công'); location.href='index.php?mod=thuoc&act=list';</script>";
    exit();
} else {
    echo "<script>alert('Lỗi Khi Xóa'); location.href='index.php?mod=thuoc&act=list';</script>";
}
?>
