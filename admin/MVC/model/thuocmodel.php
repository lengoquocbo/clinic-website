<?php
require_once 'connectdb.php';

class Medicine
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConection();
    }

    // Lấy tất cả danh sách thuốc
    public function getAll()
    {
        $result = $this->db->query("SELECT * FROM medicines");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Lấy thông tin thuốc theo ID
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM medicines WHERE medicineID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    
    public function addMedicine($data)
    {
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->db->prepare("INSERT INTO medicines (serviceID, name, function, price, status) VALUES (?, ?, ?, ?, ?)");

        // Bind các tham số vào câu lệnh SQL
        // Chú ý kiểu của serviceID là integer nên bạn cần đảm bảo nó là số nguyên
        $stmt->bind_param("issss", $data['serviceID'], $data['name'], $data['function'], $data['price'], $data['status']);

        // Thực hiện câu lệnh
        return $stmt->execute();
    }

    // Chỉnh sửa thông tin thuốc
    public function edit_medicine($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE medicines SET serviceID = ?, name = ?, function = ?, price = ?, status = ? WHERE medicineID = ?");
        $stmt->bind_param("issssi", $data['serviceID'], $data['name'], $data['function'], $data['price'], $data['status'], $id);
        return $stmt->execute();
    }


    // Xóa thuốc theo ID
    public function delete_medicine($medicineID)
    {
        $stmt = $this->db->prepare("DELETE FROM medicines WHERE medicineID = ?");
        $stmt->bind_param("i", $medicineID);

        if (!$stmt->execute()) {
            // In ra lỗi nếu có vấn đề xảy ra
            echo "Lỗi khi xóa: " . $stmt->error;
            return false;
        }
        return true;
    }
}
