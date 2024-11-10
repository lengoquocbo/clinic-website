<?php
require_once 'connectdb.php';
class benhnhan
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConection();
    }
    public function getALL()
    {
        $stmt = $this->db->query("SELECT * FROM patients");
        return $stmt->fetch_all((MYSQLI_ASSOC));
    }
   
    public function getByid($patientID)
    {
        // Thêm điều kiện ORDER BY để lấy lần khám gần nhất
        $stmt = $this->db->prepare("
            SELECT DISTINCT
                p.patientID,
                p.fullname,
                p.phone,
                p.birthdate, 
                p.address,
                p.sex,
                e.EXID,
                e.ordernumber,
                e.visittype,
                e.exdaytime,
                e.diagnose,
                e.results,
                e.price AS examPrice,
                s.serviceID,
                s.staffID,
                s.servicename,
                s.price AS servicePrice,
                st.fullname AS staffName,
                us.userviceID
            FROM patients p
            INNER JOIN examine e ON p.patientID = e.patientID
            LEFT JOIN useservices us ON e.EXID = us.EXID
            LEFT JOIN services s ON us.serviceID = s.serviceID
            LEFT JOIN staffs st ON s.staffID = st.staffID
            WHERE p.patientID = ?
            ORDER BY e.exdaytime DESC
            LIMIT 1
        ");
    
        $stmt->bind_param("s", $patientID); // Đổi thành "s" vì patientID là string
    
        if (!$stmt->execute()) {
            return null; // Trả về null nếu có lỗi
        }
    
        $result = $stmt->get_result();
    
        // Kiểm tra nếu không có kết quả
        if ($result->num_rows === 0) {
            return null;
        }
    
        // Lấy một bản ghi duy nhất
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    
        return $data;
    }
    
    // Hoặc nếu bạn muốn tách riêng thông tin khám bệnh và dịch vụ
    public function getPatientExamInfo($patientID)
    {
        $stmt = $this->db->prepare("
            SELECT 
                p.*,
                e.EXID,
                e.ordernumber,
                e.visittype,
                e.exdaytime,
                e.diagnose,
                e.results,
                e.price AS examPrice
            FROM patients p
            INNER JOIN examine e ON p.patientID = e.patientID
            WHERE p.patientID = ?
            ORDER BY e.exdaytime DESC
            LIMIT 1
        ");
    
        $stmt->bind_param("s", $patientID);
        
        if (!$stmt->execute()) {
            return null;
        }
    
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function getPatientServices($EXID)
    {
        $stmt = $this->db->prepare("
            SELECT 
                s.serviceID,
                s.servicename,
                s.price AS servicePrice,
                st.fullname AS staffName
            FROM useservices us
            LEFT JOIN services s ON us.serviceID = s.serviceID
            LEFT JOIN staffs st ON s.staffID = st.staffID
            WHERE us.EXID = ?
        ");
    
        $stmt->bind_param("s", $EXID);
        
        if (!$stmt->execute()) {
            return [];
        }
    
        $result = $stmt->get_result();
        $services = [];
        while ($row = $result->fetch_assoc()) {
            $services[] = $row;
        }
        
        return $services;
    }

    public function searchByName($name)
    {
        $stmt = $this->db->prepare("SELECT * FROM patients WHERE fullname LIKE ?");
        $searchName = "%" . $name . "%";
        $stmt->bind_param("s", $searchName);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    public function delete_patients($patientID)
    {
        $stmt = $this->db->prepare("DELETE FROM patients WHERE patientID=?");
        $stmt->bind_param("s", $patientID);
        if (!$stmt->execute()) {
            // Nếu có lỗi xảy ra, in ra lỗi
            echo "Lỗi khi xóa: " . $stmt->error;
            return false; // Trả về false nếu có lỗi
        }
        return true; // Trả về true nếu thành công


    }
    
}
