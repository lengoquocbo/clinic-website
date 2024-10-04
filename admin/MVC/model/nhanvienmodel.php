<?php
require_once 'connectdb.php';
class Nhanvien {
    private $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConection(); 
    } 
    public function getAll() {
        $result = $this->db->query("SELECT * FROM staffs");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id){
        $stmt = $this->db->prepare("SELECT * FROM staffs WHERE staffID = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function addStaff($data) {
        $stmt = $this->db->prepare("INSERT INTO staffs (staffID, fullname, position, phone, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $data['staffID'], $data['fullname'], $data['position'], $data['phone'], $data['status']);
        return $stmt->execute();
    }
    public function editStaff($id, $data) {
        $stmt = $this->db->prepare("UPDATE staffs SET fullname = ?, position = ?, phone = ?, status = ? WHERE staffID = ?");
        $stmt->bind_param("sssss", $data['fullname'], $data['position'], $data['phone'], $data['status'], $id);
        return $stmt->execute();
    }
    public function deleteStaff($id){
        $stmt = $this->db->prepare("DELETE FROM staffs WHERE staffID = ?");
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }
}
?>
