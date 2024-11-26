<?php
require_once 'connectdb.php';
class Nguoidung{

    private $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConection();
    }

    //get all
    public function getAll() {
        $result = $this->db->query("SELECT * FROM user");
        return $result->fetch_all(MYSQLI_ASSOC);
    }


  public function adduser($data){
   
    $stmt = $this->db->prepare("INSERT INTO user ( username, mail, phone, pass, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $data['username'], $data['mail'], $data['phone'], $data['pass'],$data['role'] );
    return $stmt->execute();
}
// Xóa nhân viên theo ID
public function delete_user($userID) {
    $stmt = $this->db->prepare("DELETE FROM user WHERE userID = ?");
    $stmt->bind_param("s", $userID);
    
    if (!$stmt->execute()) {
        // Nếu có lỗi xảy ra, in ra lỗi
        echo "Lỗi khi xóa: " . $stmt->error;
        return false; // Trả về false nếu có lỗi
    }
    return true; // Trả về true nếu thành công
}
}

?>