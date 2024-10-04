<?php
require_once 'connectdb.php';
class Medicine {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConection();
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM medicines");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM medicines WHERE medicineID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function add_medicine($data) {
        $stmt = $this->db->prepare("INSERT INTO medicines (serviceID, name, function, price, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $data['serviceID'], $data['name'], $data['function'], $data['price'], $data['status']);
        return $stmt->execute();
    }

    public function edit_medicine($id, $data) {
        $stmt = $this->db->prepare("UPDATE medicines SET serviceID = ?, name = ?, function = ?, price = ?, status = ? WHERE medicineID = ?");
        $stmt->bind_param("issssi", $data['serviceID'], $data['name'], $data['function'], $data['price'], $data['status'], $id);
        return $stmt->execute();
    }

    public function delete_medicine($id) {
        $stmt = $this->db->prepare("DELETE FROM medicines WHERE medicineID = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // public function getMedicinesByservice($serviceID) {
    //     $stmt = $this->db->prepare("SELECT m.* FROM medicines m JOIN services s ON m.medicineID = s.medicineID WHERE s.serviceID = ?");
    //     $stmt->bind_param("i", $serviceID);
    //     $stmt->execute();
    //     return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    // }
}
?>