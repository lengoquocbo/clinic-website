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
        // Kiểm tra xem $id có phải là số nguyên không
        if (!is_numeric($id)) {
            return null; // Hoặc xử lý lỗi phù hợp
        }
    
        // Chuẩn bị và thực thi câu truy vấn
        $stmt = $this->db->prepare("SELECT * FROM medicines WHERE medicineID = ?");
        if ($stmt === false) {
            die('Error in prepare: ' . $this->db->error);
        }
    
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // Lấy kết quả và kiểm tra
        $result = $stmt->get_result();
        return $result ? $result->fetch_assoc() : null; // Trả về mảng kết quả hoặc null
    }
    

    
    public function addMedicine($data)
    {

        $stmt = $this->db->prepare("INSERT INTO medicines (serviceID, name, function, quantity ,price, status) VALUES (?, ?, ?, ?, ?,?)");
        $stmt->bind_param("isssss", $data['serviceID'], $data['name'], $data['function'], $data['quantity'] ,$data['price'], $data['status']);
        return $stmt->execute();
    }

    // Chỉnh sửa thông tin thuốc
    public function edit_medicine($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE medicines SET serviceID = ?, name = ?, function = ?, quantity=?,price = ?, status = ? WHERE medicineID = ?");
        $stmt->bind_param("isssssi", $data['serviceID'], $data['name'], $data['function'], $data['quantity'], $data['price'], $data['status'], $id);
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
    public function getbyServiceID($serviceID){
        $stmt = $this->db->prepare("SELECT * FROM medicines WHERE serviceID = ?");
        $stmt->bind_param("i", $serviceID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC); // Trả về tất cả các hàng dưới dạng mảng
    }
    public function createUsemedicine($mdata) {
        $stmt = $this->db->prepare("INSERT INTO usemedicines (usemedicineID, userviceID) VALUES (?, ?)");
        
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($this->db->error));
        }
    
        $stmt->bind_param("ss", $mdata['usemedicineID'], $mdata['userviceID']);
    
        if ($stmt->execute()) {
            return true; // Thành công
        } else {
            return false; // Thất bại
        }
    
        $stmt->close();
    }
}


    

