<?php
require_once __DIR__ . '../../model/lichhenmodel.php';

if (isset($_GET['id'])) {
    $appointmentID = $_GET['id'];
    $appointment = new Appointment();
    require_once __DIR__.'/../../../assets/Mail/Mail.php';
    $Mail = new Mail();
    $ApmInfo = $appointment->getByAppID($appointmentID);
    $mailaddress = $ApmInfo['mail'];
    $name = $ApmInfo['fullname'];
    $day = $ApmInfo['appointmentday'];
    // Thực hiện xóa lịch hẹn
    try {
        if ($appointment->deleteById($appointmentID)) {
            $result = $Mail->RefuseApm($mailaddress, $day, $name, $appointmentID);
            if(!$result) throw new Exception("Lỗi gửi mail");
            echo "<script>
                alert('Hủy lịch hẹn thành công!');
                window.location.href = 'index.php?mod=lichhen&act=list';
            </script>";
            exit;
        } else {
            // Nếu có lỗi khi xóa
            echo "<script>
                alert('Lỗi khi hủy lịch hẹn. Vui lòng thử lại!');
                window.history.back();
            </script>";
        }
    } catch (Exception $e) {
        // Xử lý lỗi cụ thể nếu có
        echo "<script>
            alert('Lỗi: " . addslashes($e->getMessage()) . "');
            window.history.back();
        </script>";
    }
} else {
    // Nếu không có ID, quay lại danh sách lịch hẹn
    echo "<script>
        alert('Không tìm thấy lịch hẹn để hủy!');
        window.location.href = 'index.php?mod=lichhen&act=list';
    </script>";
}
?>