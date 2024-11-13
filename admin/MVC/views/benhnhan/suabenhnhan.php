<?php
require_once __DIR__ .'../../../model/benhnhanmodel.php';

$patientID = trim($_GET['id']);
$benhnhan = new benhnhan();
$data = $benhnhan->getByid($patientID);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $EXID = $_POST['EXID'];

    $pdata = [
        'fullname' => $_POST['fullname'],
        'sex' => $_POST['sex'],
        'birthdate' => $_POST['birthdate'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address']
    ];
    $exdata = [
        'diagnose' => $_POST['diagnose'],
        'results' => $_POST['results']
    ];

    // Biến cờ để kiểm tra thành công của cả hai phương thức
    if ($benhnhan->updatepatients($patientID, $pdata) && $benhnhan->updateexamine($EXID, $exdata)) {
        echo "<script>alert('Cập nhật thông tin thành công');</script>";
        header("Location: index.php?mod=benhnhan&act=list");
        exit();
    } else {
        echo "<script>alert('Lỗi khi cập nhật thông tin. Vui lòng kiểm tra lại.');</script>";
    }
    
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Bệnh Nhân</title>
    <style>
        .table_container {
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px, rgb(51, 51, 51) 0px 0px 0px 3px;            display: flex;
            flex-direction: column;
            width: 1000px;
            margin-top: 30px;
            color: var(--color-primary-text);
        }

        .content-container {
            display: flex;
            justify-content: space-between;
            border-top: 1px solid gray;
        }

        .form_left, .form_right {
            width: 48%;
            display: flex;
            flex-direction: column;
        }

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
            background-color: #f6c23e;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
            height: 25px;

        }

        .medicine-list__action-btn:hover {
            background-color: #0056b3;
        }

        .btn {
            display: inline ;
            margin-left: 880px;
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
        .medicine-listbtn{
            padding: 9px 12px;
            height: 40px;
border: 1px solid ;
background-color: #007bff;
color: white;
border-radius: 4px;

        }
        .lspan input{
    height: 30px;
border-radius: 4px;
border: 1px solid gray;
        }
    </style>
</head>

<body>
    <div class="around">
        <div class="table_container">
            <?php if (!empty($data)): ?>
                <h2>Sửa hồ sơ của bệnh nhân: <?php echo $data[0]['patientID']; ?></h2>
                <form method="POST" action="">
                    <div class="content-container">
                        <div class="form_left">
                            <h3>Thông tin bệnh nhân</h3>
                            <div class="lspan" style="display: none;"><label> <input type="text" name="patientID" value="<?php echo $data[0]['patientID']; ?>"></label></div>
                            <div class="lspan" style="display: none;"><label> <input type="text" name="EXID" value="<?php echo $data[0]['EXID']; ?>"></label></div>

                            <div class="lspan"> <label for="ordernumber">Lượt khám: </label><span><?php echo $data[0]['ordernumber']; ?></span></div>
                            <div class="lspan"><label>Họ và tên: <input type="text" name="fullname" value="<?php echo $data[0]['fullname']; ?>"></label></div>
                            <div class="lspan"><label>Giới tính: <input type="text" name="sex" value="<?php echo $data[0]['sex']; ?>"></label></div>
                            <div class="lspan"><label>Sinh nhật: <input type="date" name="birthdate" value="<?php echo $data[0]['birthdate']; ?>"></label></div>
                            <div class="lspan"><label>Số điện thoại: <input type="text" name="phone" value="<?php echo $data[0]['phone']; ?>"></label></div>
                            <div class="lspan"> <label>Địa chỉ: <input type="text" name="address" value="<?php echo $data[0]['address']; ?>"></label></div>
                        </div>
                     <div class="form_right">
                            <h3>Thông tin khám bệnh</h3>
                            <div class="lspan"> <label for="staffName">Bác sĩ khám bệnh: </label><span><?php echo $data[0]['staffName']; ?></span></div>
                            <div class="lspan"> <label for="exdaytime">Ngày khám: </label><span><?php echo $data[0]['exdaytime']; ?></span></div>
                            <div class="lspan"> <label for="servicename">Khám về: </label><span><?php echo $data[0]['servicename']; ?></span></div>
                            <div class="lspan"> <label for="visittype">Hình thức khám: </label><span><?php echo $data[0]['visittype']; ?></span></div>
                            <div class="lspan"><label>Chuẩn đoán: <input type="text" name="diagnose" value="<?php echo $data[0]['diagnose']; ?>"></label></div>
                            <div class="lspan"><label>Kết luận: <input type="text" name="results" value="<?php echo $data[0]['results']; ?>"></label></div>
                        </div>
                    </div>
                    <div class="btn">
                        <button type="submit" class="medicine-listbtn">Lưu</button>
                        <a href="index.php?mod=benhnhan&act=edit" class="medicine-list__action-btn">Hủy</a>
                    </div>
                </form>
            <?php else: ?>
                <p>Không tìm thấy thông tin bệnh nhân.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
