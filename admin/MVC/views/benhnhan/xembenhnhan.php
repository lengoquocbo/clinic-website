<?php
require_once 'C:\xampp\htdocs\clinic-website\admin\MVC\model\benhnhanmodel.php';
$patientID = trim($_GET['id']);
$benhnhan = new benhnhan();
$data = $benhnhan->getByid($patientID); // Lưu kết quả truy vấn vào biến $data

// Lấy danh sách thuốc theo `userviceID`
$userviceID = isset($data[0]['userviceID']) ? $data[0]['userviceID'] : null;
$medicineList = $benhnhan->getmedicine($userviceID);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bệnh nhân</title>
    <style>
        .table_container {
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            width: 1000px;
            margin-top: 30px;
            color: var(--color-primary-text);
        }

        .content-container {
            display: flex;
            justify-content: space-between;
            
        }

        .form_left, .form_right {
            width: 48%;
            display: flex;
            flex-direction: column;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;        }

        .form_left label, .form_right label {
            font-weight: bold;
            margin-top: 10px;
        }

        .form_left span, .form_right span {
            margin-bottom: 10px;
        }

        .lspan {
            display: inline-block;
            margin-top: 10px;
            margin-left: 10px;
        }

        .medicine-list__action-btn {
            display: inline-block;
            padding: 6px 12px;
            margin: 2px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
        }

        .medicine-list__action-btn:hover {
            background-color: #0056b3;
        }

        .btn {
            display: inline;
            margin-left: auto;
        }

        table {
            width: 100%;
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: white;
        }

        table th, table td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ccc;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
        }

        table td {
            color: #555;
        }

    </style>
</head>

<body>
    <div class="around">
        <div class="table_container">
            <?php if (!empty($data)): ?>
                <h2 class="medicine-list__title">Hồ sơ của bệnh nhân: <?php echo $data[0]['patientID']; ?></h2>
                <div class="content-container">
                    <div class="form_left">
                        <h3>Thông tin bệnh nhân</h3>
                        <div class="lspan"> <label for="ordernumber">Lượt khám: </label><span><?php echo $data[0]['ordernumber']; ?></span> </div>
                        <div class="lspan"> <label for="fullname">Họ và tên: </label><span><?php echo $data[0]['fullname']; ?></span></div>
                        <div class="lspan"> <label for="sex">Giới tính: </label><span><?php echo $data[0]['sex']; ?></span></div>
                        <div class="lspan"> <label for="birthdate">Sinh nhật: </label><span><?php echo $data[0]['birthdate']; ?></span></div>
                        <div class="lspan"> <label for="phone">Số điện thoại: </label><span><?php echo $data[0]['phone']; ?></span></div>
                        <div class="lspan"> <label for="address">Địa chỉ: </label><span><?php echo $data[0]['address']; ?></span></div>
                    </div>
                    <div class="form_right">
                        <h3>Thông tin khám bệnh</h3>
                        <div class="lspan"> <label for="staffName">Bác sĩ khám bệnh: </label><span><?php echo $data[0]['staffName']; ?></span></div>
                        <div class="lspan"> <label for="exdaytime">Ngày khám: </label><span><?php echo $data[0]['exdaytime']; ?></span></div>
                        <div class="lspan"> <label for="servicename">Khám về: </label><span><?php echo $data[0]['servicename']; ?></span></div>
                        <div class="lspan"> <label for="visittype">Hình thức khám: </label><span><?php echo $data[0]['visittype']; ?></span></div>
                        <div class="lspan"> <label for="diagnose">Chuẩn đoán: </label><span><?php echo $data[0]['diagnose']; ?></span></div>
                        <div class="lspan"> <label for="results">Kết luận: </label><span><?php echo $data[0]['results']; ?></span></div>
                        
                        <h3>Phương pháp trị bệnh</h3>
                        <table>
                            <tr>
                                <th>Tên Thuốc</th>
                                <th>Số lượng</th>
                                <th>Liều lượng</th>
                            </tr>
                            <?php if (!empty($medicineList)): ?>
                                <?php foreach ($medicineList as $medicine): ?>
                                    <tr>
                                        <td><?php echo $medicine['name']; ?></td>
                                        <td><?php echo $medicine['SOLUONG']; ?></td>
                                        <td><?php echo $medicine['note'];?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">Không có thông tin thuốc</td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <p>Không tìm thấy thông tin bệnh nhân.</p>
            <?php endif; ?>
            <div class="btn">
                <a href="index.php?mod=benhnhan&act=list" class="medicine-list__action-btn">Quay lại</a>
                <a style="background-color:#f6c23e;" href="index.php?mod=benhnhan&act=edit&id=<?php echo $data[0]['patientID']; ?>" class="medicine-list__action-btn">Sửa</a>
                <a style="background-color:green;"  href="index.php?mod=benhnhan&act=in&id=<?php echo $data[0]['patientID']; ?>" class="medicine-list__action-btn" style="background-color: red;">Xuất PDF</a>

            </div>
        </div>
    </div>
</body>

</html>
