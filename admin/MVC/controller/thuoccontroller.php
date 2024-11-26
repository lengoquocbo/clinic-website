<?php
require_once '../model/thuocmodel.php';

class MedicineController
{
    private $medicineModel;

    public function __construct()
    {
        $this->medicineModel = new Medicine(); // Sử dụng $this->medicineModel để gán giá trị
    }

    // Lấy danh sách thuốc
    public function index()
    {
        $thuoc_list = $this->medicineModel->getAll(); // Sử dụng $this->medicineModel
        require_once __DIR__.'../../controller/thuoccontroller.php';// Hiển thị danh sách thuốc ở giao diện
    }

    // Hiển thị chi tiết thuốc
    public function show($id)
    {
        $medicine = $this->medicineModel->getById($id); // Sử dụng $this->medicineModel
        include 'views/medicine_detail.php'; // Hiển thị chi tiết thuốc ở giao diện
    }

    // Thêm thuốc mới
    public function store($data)
    {
        $result = $this->medicineModel->addMedicine($data); // Sử dụng $this->medicineModel

        if ($result) {
            echo "Thêm thuốc thành công.";
        } else {
            echo "Thêm thuốc thất bại.";
        }
    }

    // Sửa thông tin thuốc
    public function update($id, $data)
    {
        $result = $this->medicineModel->edit_medicine($id, $data); // Sử dụng $this->medicineModel

        if ($result) {
            echo "Cập nhật thuốc thành công.";
        } else {
            echo "Cập nhật thuốc thất bại.";
        }
    }

    // Xóa thuốc
    public function destroy($id)
    {
        $result = $this->medicineModel->delete_medicine($id); // Sử dụng $this->medicineModel

        if ($result) {
            echo "Xóa thuốc thành công.";
        } else {
            echo "Xóa thuốc thất bại.";
        }
    }

    // Lấy thuốc theo serviceID
    public function getByService($serviceID)
    {
        $medicines = $this->medicineModel->getbyServiceID($serviceID); // Sử dụng $this->medicineModel
        include 'views/medicine_service.php'; // Hiển thị danh sách thuốc theo service
    }

    // Tạo usemedicine
    public function createUseMedicine($data)
    {
        $result = $this->medicineModel->createUsemedicine($data); // Sử dụng $this->medicineModel

        if ($result) {
            echo "Tạo `usemedicine` thành công.";
        } else {
            echo "Tạo `usemedicine` thất bại.";
        }
    }
}
