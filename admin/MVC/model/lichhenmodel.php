<?php
class Appointment {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $query = "SELECT a.appointmentID, p.fullname, a.appointmentday, p.phone 
                  FROM appointments a
                  JOIN patients p ON a.patientID = p.patientID
                  ORDER BY a.appointmentday DESC";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT a.*, p.fullname, p.phone 
                                    FROM appointments a
                                    JOIN patients p ON a.patientID = p.patientID
                                    WHERE a.appointmentID = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO appointments (appointmentID, patientID, appointmentday, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $data['appointmentID'], $data['patientID'], $data['appointmentday'], $data['status']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE appointments SET patientID = ?, appointmentday = ?, status = ? WHERE appointmentID = ?");
        $stmt->bind_param("ssss", $data['patientID'], $data['appointmentday'], $data['status'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM appointments WHERE appointmentID = ?");
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }

    public function confirmAppointment($id) {
        $stmt = $this->db->prepare("UPDATE appointments SET status = 'confirmed' WHERE appointmentID = ?");
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }

    public function cancelAppointment($id) {
        $stmt = $this->db->prepare("UPDATE appointments SET status = 'cancelled' WHERE appointmentID = ?");
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }

    public function getUpcomingAppointments($limit = 10) {
        $query = "SELECT a.appointmentID, p.fullname, a.appointmentday, p.phone 
                  FROM appointments a
                  JOIN patients p ON a.patientID = p.patientID
                  WHERE a.appointmentday >= CURDATE()
                  ORDER BY a.appointmentday ASC
                  LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>