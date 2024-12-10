
<?php 
session_start();

// Cho phép CORS nếu cần
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once __DIR__.'\..\..\admin\MVC\model\benhnhanmodel.php';
require_once __DIR__.'\..\..\admin\MVC\model\khambenhmodel.php';
require_once __DIR__.'\..\..\admin\MVC\model\lichhenmodel.php';
require_once __DIR__.'\..\..\admin\MVC\model\dichvumodel.php';



// Nếu là OPTIONS request (preflight), trả về 200 OK
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Chỉ cho phép POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    echo json_encode([
        'success' => false,
        'message' => 'Phương thức không được chấp nhận'
    ]);
    exit();
}

try {
    $benhnhan = new benhnhan();
    $reservation = new Appointment();
    $khambenh = new khambenh();
    $dichvu = new Services();

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Validate input
    if (!isset($data['phone']) || !isset($data['mail']) || !isset($data['userID']) || !isset($data['hovaten']) || !isset($data['CCCD']) 
    || !isset($data['gender']) || !isset($data['ngaykham']) || !isset($data['dateofbirth']) || !isset($data['service']) || !isset($data['address']) || !isset($data['message'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Thiếu thông tin dat lich'
        ]);
        exit();
    }

    //tao cac ma va chen thong tin

    $patientID = generatepatientID($data['hovaten'], $data['ngaykham']);
    $ApmID = createApmID($patientID);
    $EXID = createEXID();
    $USVID = generateServiceCode();
    //  $pdata['patientID'], $pdata['userID'], $pdata['fullname'], $pdata['cccd'], $pdata['birthdate'], $pdata['sex'], $pdata['phone'], $pdata['address']


    //khoi tao data benh nhan
    $pdata = array (
        'patientID' => $patientID,
        'userID' => $data['userID'],
        'fullname' => $data["hovaten"],
        'cccd' => $data['CCCD'],
        'birthdate' => $data['dateofbirth'],
        'sex' => $data['gender'],
        'phone' => $data['phone'],
        'address' => $data['address']
    );
    //KIEM TRA KET QUA TRA VE
    $result1 = $benhnhan->addPatient($pdata) ? 0 : 1;

    //khoi tao data lich hen
    $rdata = array(
        'appointmentID' => $ApmID,
        'patientID' => $patientID,
        'EXID' => $EXID,
        'appoitmentday' => $data['ngaykham'],
        'status' => 'waiting'
         
    );

    //KIEM TRA KET QUA TRA VE
    $result2 = $reservation->create($rdata) ? 0 : 1;


    //khoi tao data don kham benh
    $exdata = array(
        'EXID' => $EXID,
        'patientID' => $patientID
    );
    
    //KIEM TRA KET QUA TRA VE
    $result3 = $khambenh->crtEmptyEx($exdata) ? 0 : 1;
    $id =$data['service'];
    $totalprice = $dichvu->getById($id)['price']; // or whatever the correct key is
    //khoi tao data su dung dich vu
    $usdata = array(
        'userviceID' => $USVID,
        'EXID' => $EXID,
        'serviceID' => $data['service'],
        'totalprice' => $totalprice
    );

    //KIEM TRA KET QUA TRA VE
    $result4 = $khambenh->createUseservice($usdata) ? 0 : 1;
    

    // TONG HOP KET QUA => KET LUAN
    if( ($result1 + $result2 + $result3 + $result4) == 0) {
        echo json_encode([
            'success' => true,
            'message' => 'Dat lich thanh cong'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Đat lich khong thanh cong'
        ]);
    }

} catch(Exception $e) {
    error_log("General Error: " . $e->getMessage());
    echo $e->getMessage();
    
    echo json_encode([
        'success' => false,
        'message' => 'Đã xảy ra lỗi'
    ]);
}




function generatepatientID($fullName, $exdaytime)
{
    $date = new DateTime($exdaytime);
    $day = $date->format('d');
    $month = $date->format('m');
    // Normalize the name by removing diacritics
    $nameParts = explode(' ', removeDiacritics($fullName));
    $lastName = end($nameParts);
    $shortName = substr($lastName, 0, 3);
    $randomNumbers = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);

    return 'PAD' . $shortName . $randomNumbers. $day. $month;
}

function createEXID(){
    try {
        // Lấy thông tin thời gian
        $date = date('ymd');      // Năm tháng ngày: 241125
        
        // Tạo số random 3 chữ số
        $random = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        
        // Tạo mã phiếu khám: PKB-YYMMDD-RND
        $examCode = 'PKB' . '-' . $date . '-' . $random;
        
        return $examCode;
        
    } catch (Exception $e) {
        return "Lỗi: " . $e->getMessage();
    }
}

function createApmID($patientCode){
    // Lấy timestamp hiện tại
    $timestamp = time();
    
    // Lấy ngày giờ hiện tại
    $date = date('ymd', $timestamp);  // Format: 241125 (năm/tháng/ngày)
    
    // Tạo số random 3 chữ số
    $random = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
    
    // Tạo mã lịch hẹn: APP + mã bệnh nhân + ngày + số random
    $appointmentCode = 'APP' . $patientCode . $date . $random;
    
    return $appointmentCode;
}


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

function generateServiceCode() {
    try {
        // Prefix cho dịch vụ
        $prefix = 'UDV';
        
        // Lấy thông tin thời gian
        $date = date('ymd');      // Năm tháng ngày: 241125
        
        // Tạo số random 3 chữ số
        $random = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        
        // Tạo mã dịch vụ: DV-YYMMDD-RND
        $serviceCode = $prefix . '-' . $date . '-' . $random;
        
        return $serviceCode;
        
    } catch (Exception $e) {
        return "Lỗi: " . $e->getMessage();
    }
 }

?>

