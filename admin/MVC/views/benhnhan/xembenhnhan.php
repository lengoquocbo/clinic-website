<?php 
require_once 'C:\xampp\htdocs\clinic-website\admin\MVC\model\benhnhanmodel.php';
$patientID = trim($_GET['id']);
$benhnhan = new benhnhan();
$data = $benhnhan->getByid($patientID); // Lưu kết quả truy vấn vào biến $data
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
        }
        .content-container {
            display: flex;
            justify-content: space-between;
        }
        .form_left, .form_right {
            width: 48%;
            display: flex;
            flex-direction: column;
            border: 1px solid black;
        }
        .form_left label, .form_right label {
            font-weight: bold;
            margin-top: 10px;
        }
        .form_left span, .form_right span {
            margin-bottom: 10px;
        }
        .lspan{
            display: inline-block;
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
                    <div class="lspan">  <label for="ordernumber">Lượt khám:</label><span><?php echo $data[0]['ordernumber']; ?></span> </div>
                    <div class="lspan">   <label for="fullname">Họ và tên:</label><span><?php echo $data[0]['fullname']; ?></span></div>
                    <div class="lspan"> <label for="sex">Giới tính:</label><span><?php echo $data[0]['sex']; ?></span></div>
                    <div class="lspan"> <label for="birthdate">Sinh nhật:</label><span><?php echo $data[0]['birthdate']; ?></span></div>
                    <div class="lspan">  <label for="phone">Số điện thoại:</label><span><?php echo $data[0]['phone']; ?></span></div>
                    <div class="lspan">  <label for="address">Địa chỉ:</label><span><?php echo $data[0]['address']; ?></span></div>
                    </div>
                    <div class="form_right">
                     <h3>Thông tin khám bệnh</h3>
                     <div class="lspan">  <label for="staffName">Bác sĩ khám bệnh:</label><span><?php echo $data[0]['staffName']; ?></span></div>
                     <div class="lspan"> <label for="exdaytime">Ngày khám:</label><span><?php echo $data[0]['exdaytime']; ?></span></div>
                     <div class="lspan"> <label for="servicename">Khám về:</label><span><?php echo $data[0]['servicename']; ?></span></div>
                     <div class="lspan"> <label for="visittype">Hình thức khám:</label><span><?php echo $data[0]['visittype']; ?></span></div>
                     <div class="lspan"> <label for="diagnose">Chuẩn đoán:</label><span><?php echo $data[0]['diagnose']; ?></span></div>
                     <div class="lspan"> <label for="results">Kết luận:</label><span><?php echo $data[0]['results']; ?></span></div>
                        <h3>Phương khám trị bệnh</h3>
                        <table>
                            <tr>
                                <th>Tên Thuốc</th>
                                <th>Liều lượng</th>
                            </tr>
                            <!-- Thêm dữ liệu thuốc ở đây nếu có -->
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <p>Không tìm thấy thông tin bệnh nhân.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
