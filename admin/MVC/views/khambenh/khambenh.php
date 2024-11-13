<?php

require_once __DIR__ .'../../../model/khambenhmodel.php';
require_once __DIR__ .'../../../model/thuocmodel.php';



function generateUsemedicine($userviceID = '000')
{
    $randomNumbers = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
    $randomNumbers1 = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
    return "USM" . $userviceID . $randomNumbers . $randomNumbers1;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $examinationModel = new khambenh();
    $exdaytime = $_POST['exdaytime'];
    $fullname = $_POST['fullname'];

    $data = [
        'exdaytime' =>  $exdaytime,
        'diagnose' => $_POST['diagnose'],
        'results' => $_POST['prescription'],
        'bloodpressure'=>$_POST['bloodpressure'],
        'heartrate'=>$_POST['heartrate']
    ];
    $serviceID = $_POST['serviceID'];
    $appointmentID = $_POST['appointmentID'];
    $EXID = $_POST['EXID'];
    $userviceID = $_POST['userviceID'];
    $usemedicineID = generateUsemedicine($userviceID);

    // Xử lý khi nhấn nút Hoàn Thành
    if (isset($_POST["complete"])) {
        $isUpdated = $examinationModel->update($EXID, $data);
        if ($isUpdated) {
            echo "<script>alert('Hoàn thành hồ sơ'); location.href='index.php?mod=lichhen&act=list';</script>";
        } else {
            echo "<script>alert('Lỗi khi cập nhật hồ sơ'); location.href='index.php?mod=lichhen&act=list';</script>";
        }
    }
    // Xử lý khi nhấn nút Kê Thuốc
    elseif (isset($_POST["prescribe"])) {
        $isUpdated = $examinationModel->update($EXID, $data);
        if ($isUpdated) {
            $medicineModel = new Medicine();
            $mdata = [
                'usemedicineID' => $usemedicineID,
                'userviceID' => $userviceID
            ];
            // $medicineModel->createUsemedicine($mdata);
            $examinationModel->updateAppointmentStatus($appointmentID);
            echo "<script>alert('Hoàn thành hồ sơ');</script>";
            echo "<script> location.href='index.php?mod=khambenh&act=kethuoc&us=$userviceID&s=$serviceID';</script>";
        } else {
            echo "<script>alert('Lỗi khi cập nhật hồ sơ'); location.href='index.php?mod=lichhen&act=list';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <title>Khám Bệnh</title>
    <style>
        .form_container {
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
        }

        .form-main {
            display: flex;
            flex-direction: row;
        }

        .form_title {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .form_group {
            margin-bottom: 15px;
            width: 70%;
        }

        .form_group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .form_group input,
        .form_group textarea {
            width: 90%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form_group textarea {
            resize: vertical;
        }

        .submit_btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 50%;
        }

        .submit_btn:hover {
            background-color: #218838;
        }

        .right-form {
            width: 50%;
            margin-left: 40px;
            margin-right: 20px;
        }

        .right-form label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .right-form input,
        .right-form select,
        .right-form textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
        }

        .button {
            display: flex;
            flex-direction: row;
            gap: 20px;
            margin-top: 20px;
        }

        .date-container {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .calendar-icon {
            position: absolute;
            top: 50%;
            right: 30px;
            transform: translateY(-50%);
            color: #555;
            cursor: pointer;
        }

        .calendar-icon:hover {
            color: #218838;
        }
    </style>
</head>

<body>
    <div class="form_container">
        <h2 class="form_title">Thông Tin Khám Bệnh</h2>
        <?php
        require_once '../model/lichhenmodel.php';
        require_once '../model/dichvumodel.php';
        if (isset($_GET['id'])) {
            $appointmentID = $_GET['id'];
            $khambenhmodel = new Appointment();
            $appointment = $khambenhmodel->getById($appointmentID);
            $serviceModel = new Services();
            $allServices = $serviceModel->getAll();
            if ($appointment) {
                $EXID = isset($appointment['EXID']) ? $appointment['EXID'] : null; // Kiểm tra EXID
        ?>
                <form action="" method="POST">
                    <input type="hidden" name="appointmentID" value="<?= $appointment['appointmentID'] ?>">
                    <input type="hidden" name="EXID" value="<?= $EXID ?>">
                    <input type="hidden" name="appointmentID" value="<?= $appointment['serviceID'] ?>">
                    <div class="form-main">
                        <div class="form_group">
                            <input type="hidden" id="userviceID" name="userviceID" value="<?= isset($appointment['userviceID']) ? $appointment['userviceID'] : '' ?>">
                            <label for="ordernumber">Số thứ tự: <?php echo $appointment['ordernumber']; ?> </label>
                            <label for="fullname">Họ và tên:</label>
                            <input type="text" id="fullname" name="fullname" value="<?= $appointment['fullname'] ?>" readonly>
                            <label for="birthdate">Sinh nhật:</label>
                            <input type="text" id="birthdate" name="birthdate" value="<?= $appointment['birthdate'] ?>" readonly>
                            <label for="address">Địa chỉ:</label>
                            <input type="text" id="address" name="address" value="<?= $appointment['address'] ?>" readonly>
                            <label for="appointmentday">Ngày giờ đặt:</label>
                            <input type="text" id="appointmentday" name="appointmentday" value="<?= $appointment['appointmentday'] ?>" readonly>
                            <label for="exdaytime">Ngày giờ khám:</label>
                            <div class="date-container">
                                <input type="text" id="exdaytime" name="exdaytime" placeholder="Vui lòng chọn ngày-giờ khám" value="<?= $appointment['exdaytime'] ?>">
                                <span class="calendar-icon">
                                    <i class="fa fa-calendar-alt"></i>
                                </span>
                            </div>
                            <label for="diagnose">Chuẩn đoán:</label>
                            <textarea id="diagnose" name="diagnose" placeholder="Nhập chuẩn đoán của bác sĩ" required></textarea>
                            <label for="prescription">Kết Luận:</label>
                            <textarea id="prescription" name="prescription" placeholder="Nhập kết luận" required></textarea>
                        </div>
                        <div class="right-form">
                            <label style="margin-top: 20px;" for="serviceID">Dịch vụ đã đặt:</label>
                            <select id="serviceID" name="serviceID" required>
                                <?php foreach ($allServices as $service): ?>
                                    <option value="<?= $service['serviceID'] ?>" <?= $service['serviceID'] == $appointment['serviceID'] ? 'selected' : '' ?>>
                                        <?= $service['servicename'] ?> <?= $service['serviceID'] == $appointment['serviceID'] ? '✓' : '' ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="visittype">Hình thức khám:</label>
                            <input type="text" id="visittype" name="visittype" value="<?= $appointment['visittype'] ?>" readonly>
                            <label for="bloodpressure">Huyết áp:</label>
                            <input type="number" name="bloodpressure" id="bloodpressure" value="118" min="60" style="width: 80px;" > 
                            <span>mmHg</span>



                            <label for="heartrate">Nhịp tim:</label>
                            <input type="number" name="heartrate" id="heartrate" value="120" min="40" style="width: 80px;">
                            <span>Nhịp/phút</span>

                        </div>
                    </div>
                    <div class="button">
                        <button class="submit_btn" type="submit" name="complete">Hoàn Thành</button>
                        <button class="submit_btn" type="submit" name="prescribe">Kê Thuốc</button>
                    </div>
                </form>
                <script>
                    flatpickr("#exdaytime", {
                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                        allowInput: true
                    });
                    const calendarIcon = document.querySelector('.calendar-icon');
                    calendarIcon.addEventListener('click', () => {
                        flatpickr("#exdaytime").open();
                    });
                </script>
        <?php
            } else {
                echo "<p>Không tìm thấy thông tin khám bệnh.</p>";
            }
        } else {
            echo "<p>Không có ID cuộc hẹn.</p>";
        }
        ?>
    </div>
</body>

</html>