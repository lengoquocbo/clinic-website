<?php
require_once 'connectdb.php';
class Services{

    private $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConection();
    }

    //get all
    public function getAll() {
        $result = $this->db->query("SELECT * FROM services");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

   // Get service by ID
    public function getById($id) {
        $statement = $this->db->prepare("SELECT * FROM services WHERE serviceID = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_assoc();
    }   

    public function addService($data) {
        $statement = $this->db->prepare(
            "INSERT INTO services (staffID, servicename, price, description) VALUES (?, ?, ?, ?)"
        );
        $statement->bind_param("ssis", $data['staffID'], $data['servicename'], $data['price'], $data['description']);
        return $statement->execute();
    }

   

    // Edit service by ID
    public function editById($id, $data) {
        $statement = $this->db->prepare(
            "UPDATE services SET staffID = ?, servicename = ?, price = ?, description = ? WHERE serviceID = ?"
        );
        $statement->bind_param("ssisi", $data['staffID'], $data['servicename'], $data['price'], $data['description'], $id);
        return $statement->execute();
    }

    // Delete service by ID
    public function delete_service($id) {
        $stmt = $this->db->prepare("DELETE FROM services WHERE serviceID = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Search service by name
    public function search_by_name($servicename) {
        $stmt = $this->db->prepare("SELECT * FROM services WHERE servicename LIKE CONCAT('%', ?, '%')");
        $stmt->bind_param("s", $servicename);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Search service by price
    public function search_price($price) {
        $stmt = $this->db->prepare("SELECT * FROM services WHERE price = ?");
        $stmt->bind_param("i", $price);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getname() {
        $result = $this->db->query("SELECT serviceID, servicename FROM services");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function createUseservice(){
        
    }

}
?>