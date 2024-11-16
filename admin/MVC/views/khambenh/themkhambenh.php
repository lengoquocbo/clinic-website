<?php
require_once __DIR__ .'../../../model/khambenhmodel.php';


function generateEXID($exdaytime, $fullname)
{
    $date = new DateTime($exdaytime);
    $day = $date->format('d');
    $month = $date->format('m');
    $nameParts = explode(' ', removeDiacritics($fullname));
    $lastName = end($nameParts);
    $namePrefix = strtoupper(substr($lastName, 0, 3));
    $randomNumber = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
    return "EX" . $day . $month . $namePrefix . $randomNumber;
}

function generatepatientID($fullName, $exdaytime, $EXID)
{
    $date = new DateTime($exdaytime);
    $day = $date->format('d');
    $month = $date->format('m');
    // Normalize the name by removing diacritics
    $nameParts = explode(' ', removeDiacritics($fullName));
    $lastName = end($nameParts);
    $shortName = substr($lastName, 0, 3);
    $randomNumbers = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);

    return 'PAD' . $shortName . $randomNumbers. $day. $month.$EXID;
}
function  gennerPayiD($EXID){
    $randomNumbers = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
     return"PAY". $EXID . $randomNumbers;

}



// Function to remove diacritics
function removeDiacritics($string)
{
    $transliteration = [
        'à' => 'a',
        'á' => 'a',
        'ạ' => 'a',
        'ả' => 'a',
        'ã' => 'a',
        'â' => 'a',
        'ầ' => 'a',
        'ấ' => 'a',
        'ậ' => 'a',
        'ẩ' => 'a',
        'ẫ' => 'a',
        'ă' => 'a',
        'ằ' => 'a',
        'ắ' => 'a',
        'ặ' => 'a',
        'ẳ' => 'a',
        'ẵ' => 'a',
        'è' => 'e',
        'é' => 'e',
        'ẹ' => 'e',
        'ẻ' => 'e',
        'ẽ' => 'e',
        'ê' => 'e',
        'ề' => 'e',
        'ế' => 'e',
        'ệ' => 'e',
        'ể' => 'e',
        'ễ' => 'e',
        'ì' => 'i',
        'í' => 'i',
        'ị' => 'i',
        'ỉ' => 'i',
        'ĩ' => 'i',
        'ò' => 'o',
        'ó' => 'o',
        'ọ' => 'o',
        'ỏ' => 'o',
        'õ' => 'o',
        'ô' => 'o',
        'ồ' => 'o',
        'ố' => 'o',
        'ộ' => 'o',
        'ổ' => 'o',
        'ỗ' => 'o',
        'ơ' => 'o',
        'ờ' => 'o',
        'ớ' => 'o',
        'ợ' => 'o',
        'ở' => 'o',
        'ỡ' => 'o',
        'ù' => 'u',
        'ú' => 'u',
        'ụ' => 'u',
        'ủ' => 'u',
        'ũ' => 'u',
        'ư' => 'u',
        'ừ' => 'u',
        'ứ' => 'u',
        'ự' => 'u',
        'ử' => 'u',
        'ữ' => 'u',
        'ỳ' => 'y',
        'ý' => 'y',
        'ỵ' => 'y',
        'ỷ' => 'y',
        'ỹ' => 'y',
        'đ' => 'd'
    ];

    // Convert to lowercase and replace diacritics
    $string = mb_strtolower($string, 'UTF-8');
    return strtr($string, $transliteration);
}


function generateUseservice($EXID)
{
    $randomNumbers = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
    return "US" . $EXID . $randomNumbers;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $khambenh = new khambenh();

    if (isset($_POST["complete"]) || isset($_POST["prescribe"])) {  // Kiểm tra cả hai nút
        $fullname = $_POST['fullname'];
        $exdaytime = $_POST['exdaytime'];
        $serviceID = $_POST['serviceID'];

        // Tạo EXID 
        $EXID = generateEXID($exdaytime, $fullname);
        $patientID = generatepatientID($fullname, $exdaytime, $EXID);
        $userviceID = generateUseservice($EXID, $patientID);
        $staffID = $khambenh->getstaffID($serviceID);
        $payID = gennerPayiD($EXID);

        // Thông tin bệnh nhân
        $pdata = [
            'patientID' => $patientID,
            'fullname' => $fullname,
            'birthdate' => $_POST['birthdate'],
            'sex' => $_POST['sex'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address']
        ];

        // Kiểm tra bệnh nhân đã tồn tại hay chưa
        $existingPatient = $khambenh->getPatientByPhone($_POST['phone']);
        if ($existingPatient) {
            $patientID = $existingPatient['patientID'];
        } else {
            $khambenh->createPatient($pdata);
        }

        // Chuẩn bị dữ liệu cho bảng examine
        $exdata = [
            'EXID' => $EXID,
            'patientID' => $patientID,
            'staffID' => $staffID,
            'ordernumber' => $_POST['ordernumber'],
            'visittype' => $_POST['visittype'],
            'exdaytime' => $exdaytime,
            'diagnose' => $_POST['diagnose'],
            'results' => $_POST['prescription'],
            'heartrate' => $_POST['heartrate'],
            'bloodpressure' => $_POST['bloodpressure']
        ];

        try {
            $khambenh->createExamine($exdata);

            // Tạo bản ghi trong bảng useservices
            $sdata = [
                'userviceID' => $userviceID,
                'EXID' => $EXID,
                'serviceID' => $serviceID,
                'totalprice' => $_POST['price']
            ];
             $paydata =[
                'payID'=> $payID,
                'EXID' => $EXID
             ];
            $khambenh->createpayment($paydata);
            if ($khambenh->createUseservice($sdata)) {
                if (isset($_POST["prescribe"])) {
                    // Nếu nhấn "Kê Thuốc", điều hướng đến trang kê thuốc với `userviceID`
                    header("Location: index.php?mod=khambenh&act=kethuoc&us=$userviceID&s=$serviceID&p=$patientID");
                    exit;
                } else {
                    // Nếu nhấn "Hoàn Thành", điều hướng đến danh sách lịch hẹn
                    echo "<script>alert('Hoàn thành hồ sơ'); location.href='index.php?mod=lichhen&act=list';</script>";
                }
            } else {
                throw new Exception("Không thể tạo hồ sơ khám bệnh.");
            }
        } catch (Exception $e) {
            echo "<script>alert('" . $e->getMessage() . "'); location.href='index.php?mod=lichhen&act=add';</script>";
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
            max-width: 800px;
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
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 10px;
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

        .button a {
            text-decoration: none;
            color: #fff;
            text-align: center;
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
        require_once '../model/dichvumodel.php';
        $serviceModel = new Services();
        $allServices = $serviceModel->getAll();
        ?>

        <form action="" method="POST">
            <div class="form-main">
                <div class="form_group">
                    <input type="number" name="ordernumber" id="ordernumber" placeholder="Số thứ tự" required>
                    <input type="text" id="fullname" name="fullname" placeholder="Nhập Họ và tên" required>
                    <input type="text" id="birthdate" name="birthdate" placeholder="Nhập ngày tháng năm sinh"
                        onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required>
                    <input type="text" id="phone" name="phone" placeholder="Số điện thoại" required>
                    <input type="text" id="address" name="address" placeholder="Nhập địa chỉ" required>

                    <div class="date-container">
                        <input type="text" id="exdaytime" name="exdaytime" placeholder="Vui lòng chọn ngày-giờ khám" required>
                        <span class="calendar-icon">
                            <i class="fa fa-calendar-alt"></i>
                        </span>
                    </div>

                    <textarea id="diagnose" name="diagnose" placeholder="Nhập chuẩn đoán của bác sĩ" required></textarea>
                    <textarea id="prescription" name="prescription" placeholder="Nhập kết luận" required></textarea>
                </div>

                <div class="right-form">
                    <label for="sex">Giới tính:</label>
                    <select name="sex" id="sex" required>
                        <option value="Nam">Nam</option>
                        <option value="Nu">Nữ</option>
                        <option value="Khac">Khác</option>
                    </select>

                    <label for="serviceID">Dịch vụ sử dụng:</label>
                    <select id="serviceID" name="serviceID" required onchange="updatePrice(this)">
                        <?php foreach ($allServices as $service): ?>
                            <option value="<?php echo $service['serviceID']; ?>" data-price="<?php echo $service['price']; ?>">
                                <?php echo $service['servicename']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <input type="hidden" name="price" id="price" value="">


                    <label for="visittype">Hình thức:</label>
                    <input type="text" id="visittype" name="visittype" value="Không hẹn trước" readonly>
                    <label for="bloodpressure">Huyết áp:</label>
                    <input type="number" name="bloodpressure" id="bloodpressure" value="118" min="60" style="width: 80px;">
                    <span>mmHg</span>



                    <label for="heartrate">Nhịp tim:</label>
                    <input type="number" name="heartrate" id="heartrate" value="120" min="40" style="width: 80px;">
                    <span>Nhịp/phút</span>
                </div>
            </div>

            <div class="button">
                <button type="submit" name="complete" class="submit_btn">Hoàn Thành</button>
                <button type="submit" name="prescribe" class="submit_btn">Kê Thuốc</button>
            </div>
        </form>
    </div>
</body>

<script>
    const dateInput = flatpickr("#exdaytime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "today"
    });

    document.querySelector(".calendar-icon").addEventListener("click", () => {
        dateInput.open();
    });

    function updatePrice(selectElement) {
    const price = selectElement.options[selectElement.selectedIndex].getAttribute('data-price');
    document.getElementById('price').value = price;
}

</script>

</html>