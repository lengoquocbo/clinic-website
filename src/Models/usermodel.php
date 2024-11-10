<?php
require_once __DIR__.'\..\..\admin\MVC\model\connectdb.php';
class User{

    private $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConection();
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
    
    // Sửa thông tin người dùng
    function updateUser($data) {
        $stmt = $this->db->prepare("UPDATE user SET username = ?, phone = ?, pass = ? WHERE userID = ?");
        $stmt->bind_param("sssi", $username, $phone, $password, $userID);
        $result = $stmt->execute();
        return $result;
    }

    function updatePass($data) {
        $stmt = $this->db->prepare("UPDATE user SET pass = ? WHERE mail = ?");
        $stmt->bind_param("ss", $data['pass'], $data['mail']);
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
}
?>