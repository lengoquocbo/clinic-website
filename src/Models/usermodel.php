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
        $stmt = $this->db->prepare("SELECT * FROM user WHERE phone = ? ");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if(password_verify($pass,  $user['pass'])){
            return $user;
        } else return NULL;
        
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
        $stmt->bind_param("ssssi", $data['name'], $data['phone'], $data['mail'], $data['pwhashed'], $role);
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
        $stmt->bind_param("si", $data['npwhashed'], $data['userID']);
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
            "SELECT st.fullname AS tennhanvien, e.exdaytime AS ngaykham, e.EXID AS mahoso, e.results AS chuandoan, u.userID AS userID
            FROM user u 
            JOIN patients p ON p.userID=u.userID
            JOIN appointments a ON a.patientID=p.patientID
            JOIN examine e ON e.EXID=a.EXID
            JOIN useservices us ON us.EXID= e.EXID
            LEFT JOIN services s ON s.serviceID= us.serviceID
            LEFT JOIN staffs st ON st.staffID=s.staffID
            WHERE u.userID= ? AND a.status = 'done' "
        );
        $stmt->bind_param("i", $userID);
        $stmt->execute();  // Just execute the statement
        $result = $stmt->get_result();
        $users = $result->fetch_all(MYSQLI_ASSOC);  // Now you can fetch data
        return $users;

    }

    function getByEXID($EXID){
        $stmt = $this->db->prepare(
            "SELECT 
            st.fullname AS tennhanvien,
             p.fullname AS tenbenhnhan, 
             p.sex  AS sex,
             p.birthdate AS ngaysinh, 
             u.phone AS phone, 
             p.address AS address, 
             e.exdaytime AS ngaykham, 
             s.servicename AS dichvu,
             e.results AS chuandoan
            FROM patients p
            INNER JOIN examine e ON p.patientID = e.patientID
            INNER JOIN user u ON u.userID = p.userID 
            LEFT JOIN useservices us ON e.EXID = us.EXID
            LEFT JOIN services s ON us.serviceID = s.serviceID
            LEFT JOIN staffs st ON st.staffID = s.staffID 
            WHERE e.EXID = ?"
        );
        $stmt->bind_param("s", $EXID);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }

    function GetMedicine($EXID){
        $stmt = $this->db->prepare(
            "SELECT m.name AS tenthuoc,
             um.quantity AS soluong,
             um.note AS ghichu 
             FROM user u JOIN patients p ON p.userID=u.userID 
             JOIN appointments a ON a.patientID=p.patientID 
             JOIN examine e ON e.EXID=a.EXID 
             JOIN useservices us ON us.EXID= e.EXID 
             LEFT JOIN usemedicines um ON um.userviceID=us.userviceID 
             LEFT JOIN medicines m ON m.medicineID=um.medicineID 
             LEFT JOIN services s ON s.serviceID= us.userviceID 
             LEFT JOIN staffs st ON st.staffID=s.staffID 
             WHERE e.EXID = ?"
        );
        $stmt->bind_param("s", $EXID);
        $stmt->execute();  // Just execute the statement
        $result = $stmt->get_result();
        $UseMedicines = $result->fetch_all(MYSQLI_ASSOC);  // Now you can fetch data
        return $UseMedicines;
    }

    function getAppointment($userID) {
        // Câu truy vấn SQL
        $sql = "
            SELECT * 
            FROM user u 
            JOIN patients p ON p.userID = u.userID 
            JOIN appointments a ON a.patientID = p.patientID 
            WHERE u.userID = ? AND a.status='waiting'
            ORDER BY a.appointmentday DESC
        ";
        
        // Chuẩn bị câu lệnh
        $stmt = $this->db->prepare($sql);

        // Gán giá trị cho tham số
        $stmt->bind_param("s", $userID);
    
        // Thực thi truy vấn
        $stmt->execute();
    
        // Lấy kết quả
        $result = $stmt->get_result();
    
        // Kiểm tra và trả về dữ liệu
        if ($result->num_rows > 0) {
            $appointments = [];
            while ($row = $result->fetch_assoc()) {
                $appointments[] = $row;
            }
            return $appointments; // Trả về danh sách các cuộc hẹn
        } else {
            return []; // Không có dữ liệu
        }
    
        // Đóng câu lệnh
        $stmt->close();
    }
    
}
?>