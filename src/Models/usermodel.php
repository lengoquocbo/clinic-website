<?php
// Đặt ở đầu file login.php


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'Database.php';

class UserModel {

    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection(); // Sửa thành getConection()
    }
    
    // hàm lấy tất cả user
    public function getall(){
        $result = $this->db->query("SELECT * from user");
        return $result->fetch_all(MYSQLI_ASSOC);    
    }
    // hàm tìm người dùng bằng phone và pass
    function checkuser($phone, $pass) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE phone = ? AND pass = ?");
        $stmt->bind_param("ss", $phone, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }
    
    // Tìm kiếm người dùng bằng username
    function findUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }

    function findUserByUserID($userID) {
        $stmt = $this->db->prepare("SELECT userID, username, phone, mail, pass FROM user WHERE userID = ?");
        $stmt->bind_param("s", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }

    function findUserByPhone($phone) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE phone = ?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }

    function findUserByMail($mail) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE mail = ?");
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }

    //Thêm người dùng mới
    function addUser($data) {
        $stmt = $this->db->prepare("INSERT INTO user (username, phone, mail, pass, role) VALUES (?, ?, ?, ?, ?)");
        $role = 1;
        $stmt->bind_param("ssssi", $data['name'], $data['phone'], $data['mail'], $data['pass'], $role);
        $result = $stmt->execute();
        return $result;
    }
    
    function updateUser($data) {
        $stmt = $this->db->prepare("UPDATE user SET phone = ?, mail = ? WHERE userID = ?");
        $stmt->bind_param("ssi", $data['phone'], $data['mail'], $data['userID']);
        $result = $stmt->execute();
        return $result;
    }

    function updatePass($data) {
        $stmt = $this->db->prepare("UPDATE user SET pass = ? WHERE userID = ?");
        $stmt->bind_param("si", $data['newpass'], $data['userID']);
        $result = $stmt->execute();
        return $result;
    }
    
    // Xóa người dùng
    function deleteUser($userID) {
        $stmt = $this->db->prepare("DELETE FROM user WHERE userID = ?");
        $stmt->bind_param("i", $userID);
        $result = $stmt->execute();
        $stmt->close();
        $this->db->close();
        return $result;
    }

    function getByUserId($userID){
        $stmt = $this->db->prepare(
            "SELECT *, e.price AS tongtienkham
            FROM user u 
            JOIN patients p ON p.userID=u.userID
            JOIN appointments a ON a.patientID=p.patientID
            JOIN examine e ON e.EXID=a.EXID
            JOIN useservices us ON us.EXID= e.EXID
            LEFT JOIN usemedicines um ON um.userviceID=us.userviceID
            LEFT JOIN medicines m ON m.medicineID=um.medicineID
            LEFT JOIN services s ON s.serviceID= us.userviceID
            LEFT JOIN staffs st ON st.staffID=s.staffID
            WHERE u.userID= ?"
        );
        $stmt->bind_param("i", $userID);
        $result = $stmt->execute();
        return $result;
    }
}
?>