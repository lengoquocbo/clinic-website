<?php
// controllers/NhanvienController.php
require_once '../model/nhanvienmodel.php';

class NhanvienController {
    private $model;

    public function __construct() {
        $this->model = new nhanvien();
    }

    public function list() {
        $nhanvien_list = $this->model->getAll();
        include 'views/nhanvien/list.php';
    }

    public function add() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Xử lý thêm nhân viên
            $data = [
                'fullname' => $_POST['fullname'],
                'position' => $_POST['position'],
                'phone' => $_POST['phone'],
                // Thêm các trường khác...
            ];
            if ($this->model->addStaff($data)) {
                header("Location: index.php?mod=nhanvien&act=list");
                exit;
            }
        }
        include 'views/nhanvien/themnhanvien.php';
    }
}