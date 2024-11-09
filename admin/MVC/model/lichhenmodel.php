<?php
require_once 'connectdb.php';

class Appointment
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConection();
    }

    // Lấy tất cả lịch hẹn kèm thông tin bệnh nhân và dịch vụ
    public function getAll()
    {
        $query = "SELECT 
    a.appointmentID,
    p.fullname,
    p.birthdate,
    a.appointmentday, 
    p.phone,
    s.servicename as serviceName,
    a.status,
    e.visittype, 
    e.ordernumber     
FROM appointments a
INNER JOIN patients p ON a.patientID = p.patientID
INNER JOIN examine e ON a.EXID = e.EXID
INNER JOIN services s ON e.EXID = s.serviceID
ORDER BY a.appointmentday DESC 
LIMIT 0, 25";
        $result = $this->db->query($query);

        if (!$result) {
            die("Error in query: " . $this->db->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Lấy chi tiết một lịch hẹn kèm đầy đủ thông tin liên quan
    // Lấy chi tiết một lịch hẹn kèm đầy đủ thông tin liên quan
    public function getById($id)
{
    $stmt = $this->db->prepare(
        "SELECT 
            a.appointmentID,
            a.appointmentday,
            a.status,
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
            e.price as examPrice,
            s.serviceID,
            s.servicename,
            s.price as servicePrice,
            us.userviceID
        FROM appointments a
        INNER JOIN patients p ON a.patientID = p.patientID
        LEFT JOIN examine e ON a.EXID = e.EXID
         LEFT JOIN useservices us ON e.EXID = us.EXID
        LEFT JOIN services s ON us.serviceID = s.serviceID
        WHERE a.appointmentID = ?"
    );

    // Kiểm tra nếu `$stmt` là `false`
    if (!$stmt) {
        die("Error preparing statement: " . $this->db->error);
    }

    $stmt->bind_param("s", $id);

    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }

    $result = $stmt->get_result();
    return $result->fetch_assoc();
}



    // Cập nhật trạng thái lịch hẹn sang confirmed và tạo bản ghi khám bệnh
    public function confirmAppointment($id)
    {
        try {
            // Bắt đầu transaction
            $this->db->begin_transaction();

            // Cập nhật trạng thái lịch hẹn
            $stmt = $this->db->prepare("UPDATE appointments SET status = 'confirmed' WHERE appointmentID = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();

            // Tạo mã khám bệnh mới
            $EXID = 'EX' . time();

            // Lấy thông tin lịch hẹn
            $appointment = $this->getById($id);

            // Tạo bản ghi khám bệnh mới
            $stmt = $this->db->prepare(
                "INSERT INTO examine (EXID, patientID, staffID, appointmentID) 
                 VALUES (?, ?, ?, ?)"
            );
            $staffID = isset($_SESSION['staffID']) ? $_SESSION['staffID'] : null;
            $stmt->bind_param("ssss", $EXID, $appointment['patientID'], $staffID, $id);
            $stmt->execute();

            // Commit transaction
            $this->db->commit();
            return $EXID; // Trả về mã khám bệnh mới tạo

        } catch (Exception $e) {
            // Nếu có lỗi, rollback các thay đổi
            $this->db->rollback();
            return false;
        }
    }

    // Hủy lịch hẹn
    public function cancelAppointment($id)
    {
        $stmt = $this->db->prepare("UPDATE appointments SET status = 'cancelled' WHERE appointmentID = ?");
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }

    // Lấy lịch hẹn của ngày hiện tại
    public function getTodayAppointments()
    {
        $query = "SELECT a.appointmentID, p.fullname, a.appoitmentday, p.phone,
                         s.servicename, a.status
                  FROM appointments a
                  JOIN patients p ON a.patientID = p.patientID
                  LEFT JOIN services s ON a.serviceID = s.serviceID
                  WHERE DATE(a.appoitmentday) = CURDATE()
                  ORDER BY a.appoitmentday ASC";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Lấy số lượng lịch hẹn theo trạng thái
    public function getAppointmentCountsByStatus()
    {
        $query = "SELECT status, COUNT(*) as count
                  FROM appointments
                  GROUP BY status";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Kiểm tra xem bác sĩ có lịch hẹn trùng giờ không
    public function checkDoctorAvailability($doctorId, $appointmentTime)
    {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) as count
             FROM appointments
             WHERE staffID = ? 
             AND appoitmentday = ?
             AND status != 'cancelled'"
        );
        $stmt->bind_param("ss", $doctorId, $appointmentTime);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'] == 0;
    }

    // Thêm lịch hẹn mới
    public function create($data)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO appointments (appointmentID, patientID, serviceID, appoitmentday, status) 
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param(
            "sssss",
            $data['appointmentID'],
            $data['patientID'],
            $data['serviceID'],
            $data['appoitmentday'],
            $data['status']
        );
        return $stmt->execute();
    }

    // Cập nhật thông tin lịch hẹn
    public function update($id, $data)
    {
        $stmt = $this->db->prepare(
            "UPDATE appointments 
             SET patientID = ?, serviceID = ?, appoitmentday = ?, status = ?
             WHERE appointmentID = ?"
        );
        $stmt->bind_param(
            "sssss",
            $data['patientID'],
            $data['serviceID'],
            $data['appoitmentday'],
            $data['status'],
            $id
        );
        return $stmt->execute();
    }

    // Xóa lịch hẹn
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM appointments WHERE appointmentID = ?");
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }
}
