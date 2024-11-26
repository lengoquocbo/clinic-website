<?php
require_once 'connectdb.php';

class khambenh
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConection();
    }

    // Xử lý tạo examination kết hợp với dịch vụ
    public function createExamine($exdata) {
        // Kiểm tra xem dữ liệu có hợp lệ không
        if (empty($exdata['EXID']) || empty($exdata['patientID']) || empty($exdata['staffID'])) {
            throw new Exception("Thiếu thông tin cần thiết để tạo hồ sơ khám bệnh.");
        }
    
        $stmt = $this->db->prepare("INSERT INTO examine (EXID, patientID, staffID, ordernumber, visittype, exdaytime, diagnose, results,heartrate,bloodpressure) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)");
        
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->db->error);
        }
    
        $stmt->bind_param("ssssssssss", $exdata['EXID'], $exdata['patientID'], $exdata['staffID'], $exdata['ordernumber'], $exdata['visittype'], $exdata['exdaytime'], $exdata['diagnose'], $exdata['results'], $exdata['heartrate'], $exdata['bloodpressure']);
        
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
    
        return true;
    }

    public function crtEmptyEx($exdata) {
        if( empty($exdata['EXID']) || empty($exdata['patientID'])){
            throw new Exception("Thiếu thông tin cần thiết để tạo hồ sơ khám bệnh.");
        }

        $stmt = $this->db->prepare("INSERT INTO examine (EXID, patientID) VALUES (?, ?)");
        $stmt->bind_param("ss", $exdata['EXID'], $exdata['patientID']);
        return $stmt->execute();
    }
    
    public function createPatient($pdata) {
        // Kiểm tra dữ liệu bệnh nhân
        if (empty($pdata['patientID']) || empty($pdata['fullname']) || empty($pdata['phone'])) {
            throw new Exception("Thiếu thông tin bệnh nhân cần thiết.");
        }
    
        $stmt = $this->db->prepare("INSERT INTO patients (patientID, fullname, birthdate, sex, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
        
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->db->error);
        }
    
        // Bind các tham số
        $stmt->bind_param("ssssss", $pdata['patientID'], $pdata['fullname'], $pdata['birthdate'], $pdata['sex'], $pdata['phone'], $pdata['address']);
        
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
    
        return true;
    }
    
    public function createUseservice($sdata)
{
    $stmt = $this->db->prepare("INSERT INTO useservices (userviceID, EXID, serviceID,totalprice) VALUES (?, ?, ?,?)");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $this->db->error);
    }
    
    $stmt->bind_param("ssss", $sdata['userviceID'], $sdata['EXID'], $sdata['serviceID'], $sdata['totalprice']);
    
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
    return true;
}
public function createpayment($paydata)
{
    $stmt = $this->db->prepare("INSERT INTO payments (payID, EXID) VALUES (?, ?)");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $this->db->error);
    }
    
    $stmt->bind_param("ss", $paydata['payID'], $paydata['EXID']);
    
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
    return true;
}

    // Hàm lấy bệnh nhân bằng số điện thoại
public function getPatientByPhone($phone)
{
    $sql = "SELECT * FROM patients WHERE phone = ?";
    $stmt = $this->db->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null; // Không tìm thấy bệnh nhân
        }
    } else {
        error_log("Error in getPatientByPhone: " . $this->db->error);
        return null;
    }
}

    public function update($EXID, $data)
{
    $this->db->begin_transaction();

    try {
        // Cập nhật thông tin khám bệnh
        $stmt = $this->db->prepare("UPDATE examine SET exdaytime = ?, diagnose = ?, results = ?, heartrate=?, bloodpressure=?  WHERE EXID = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->db->error);
        }

        // Nếu appointmentID là string, đổi "sssd" thành "ssss"
        $stmt->bind_param("ssssss", $data['exdaytime'], $data['diagnose'], $data['results'],$data['heartrate'], $data['bloodpressure'] ,$EXID);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        // Cập nhật trạng thái của lịch hẹn
        $stmt = $this->db->prepare("UPDATE appointments SET status = 'Done' WHERE EXID = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->db->error);
        }

        $stmt->bind_param("i", $EXID);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $this->db->commit();
        return true;
    } catch (Exception $e) {
        $this->db->rollback();
        error_log($e->getMessage());
        return false;
    }
}


    public function getstaffID($serviceID)
    {
        $stmt = $this->db->prepare("SELECT staffID FROM services WHERE serviceID = ?");
        if ($stmt) {
            $stmt->bind_param("s", $serviceID);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['staffID'];
            } else {
                return null;
            }
        } else {
            error_log("Error in getStaffID: " . $this->db->error);
            return null;
        }
    }
    public function updateAppointmentStatus($appointmentID) {
        $stmt = $this->db->prepare("UPDATE appointments SET status = 'Done' WHERE appointmentID = ?");
        
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($this->db->error));
        }
    
        $stmt->bind_param("s", $appointmentID); // Chuyển "i" thành "s" nếu appointmentID là chuỗi
    
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    
    
}
?>
