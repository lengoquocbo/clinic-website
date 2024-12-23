<?php
require_once __DIR__ . '../../model/lichhenmodel.php';

// Lấy ID lịch hẹn từ query string
$id = $_GET['id'];

$lichhenmodel = new Appointment();
$appointment = $lichhenmodel->getAppointmentByID($id); // Lấy thông tin lịch hẹn từ CSDL

// Kiểm tra nếu không có lịch hẹn
if (!$id) {
    echo "Lịch hẹn không tồn tại!";
    exit;
}

// Nếu form đã được gửi, xử lý cập nhật
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $appointmentday = $_POST['appointmentday'];
    $phone = $_POST['phone'];
    $description = $_POST['description'];

    // Cập nhật thông tin lịch hẹn
    $updateSuccess = $lichhenmodel->updateAppointment( $id,$appointmentday);

    if ($updateSuccess) {
        header('Location: index.php?mod=lichhen&act=list'); // Quay lại danh sách lịch hẹn
        exit;
    } else {
        $errorMessage = "Cập nhật không thành công!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật lịch hẹn</title>
</head>
<style>
    /* Container styles */
.appointment-update-container {
    width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    background-color: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Header styles */
.appointment-update-title {
    color: #2c3e50;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #eee;
    font-size: 1.5rem;
}

/* Error message styles */
.appointment-update-error {
    background-color: #ffe6e6;
    color: #d63031;
    padding: 1rem;
    margin-bottom: 1.5rem;
    border-radius: 4px;
    border-left: 4px solid #d63031;
}

/* Form styles */
.appointment-update-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.appointment-update-field {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.appointment-update-label {
    font-weight: 600;
    color: #34495e;
}

.appointment-update-input,
.appointment-update-textarea {
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.appointment-update-input:focus,
.appointment-update-textarea:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
}

.appointment-update-textarea {
    min-height: 120px;
    resize: vertical;
}

/* Button styles */
.appointment-update-button {
    background-color: #3498db;
    color: white;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.appointment-update-button:hover {
    background-color: #2980b9;
}

/* Back link styles */
.appointment-update-back {
    display: inline-block;
    margin-top: 1.5rem;
    color: #7f8c8d;
    text-decoration: none;
    transition: color 0.3s ease;
}

.appointment-update-back:hover {
    color: #34495e;
}

/* Responsive styles */
@media (max-width: 768px) {
    .appointment-update-container {
        margin: 1rem;
        padding: 1rem;
    }
}
</style>
<body>
    <div class="appointment-update-container">
        <h3 class="appointment-update-title">Cập nhật lịch hẹn</h3>
        <?php if (isset($errorMessage)): ?>
            <p class="appointment-update-error"><?= $errorMessage ?></p>
        <?php endif; ?>

        <form method="POST" action="" class="appointment-update-form">
            <div class="appointment-update-field">
                <label class="appointment-update-label" for="fullname">Họ và tên:</label>
                <input class="appointment-update-input" type="text" name="fullname" id="fullname" 
                    value="<?= htmlspecialchars($appointment['fullname']) ?>" required>
            </div>

            <div class="appointment-update-field">
                <label class="appointment-update-label" for="appointmentday">Ngày giờ đặt:</label>
                <input class="appointment-update-input" type="datetime-local" name="appointmentday" 
                    id="appointmentday" value="<?= htmlspecialchars($appointment['appointmentday']) ?>" required>
            </div>

            <div class="appointment-update-field">
                <label class="appointment-update-label" for="phone">Số điện thoại:</label>
                <input class="appointment-update-input" type="text" name="phone" id="phone" 
                    value="<?= htmlspecialchars($appointment['phone']) ?>" required>
            </div>

            <div class="appointment-update-field">
                <label class="appointment-update-label" for="description">Mô tả:</label>
                <textarea class="appointment-update-textarea" name="description" 
                    id="description"><?= htmlspecialchars($appointment['description']) ?></textarea>
            </div>

            <button class="appointment-update-button" type="submit">Cập nhật</button>
        </form>

        <a href="index.php?mod=lichhen&act=list" class="appointment-update-back">Trở lại danh sách</a>
    </div>
</body>
</html>
