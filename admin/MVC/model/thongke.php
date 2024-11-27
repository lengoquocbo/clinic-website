<?php
// File: getRevenueData.php

require_once 'connectdb.php';

$conn = Database::getInstance()->getConection();

// Truy vấn dữ liệu `exdaytime` và `price` từ bảng `examine`
$sql1 = "SELECT exdaytime, price FROM examine";
$result1 = $conn->query($sql1);

$revenueData = [];

if ($result1 && $result1->num_rows > 0) {
    $groupedData = []; // Mảng trung gian để nhóm doanh thu theo ngày

    while ($row = $result1->fetch_assoc()) {
        // Lấy ngày từ `exdaytime`
        $date = date('Y-m-d', strtotime($row["exdaytime"]));

        // Nếu ngày đã tồn tại trong mảng thì cộng thêm giá trị, nếu chưa thì khởi tạo
        if (isset($groupedData[$date])) {
            $groupedData[$date] += (int)$row["price"];
        } else {
            $groupedData[$date] = (int)$row["price"];
        }
    }

    // Chuyển dữ liệu từ mảng nhóm sang mảng `revenueData`
    foreach ($groupedData as $date => $totalRevenue) {
        $revenueData[] = [
            "date" => $date,
            "revenue" => $totalRevenue
        ];
    }
}

// Truy vấn dữ liệu dịch vụ và số lần sử dụng
$sql2 = "SELECT s.servicename, COUNT(*) AS usage_count
         FROM useservices u
         JOIN services s ON s.serviceID = u.serviceID
         GROUP BY s.serviceID, s.servicename";
$result2 = $conn->query($sql2);

$serviceData = [];

if ($result2 && $result2->num_rows > 0) {
    // Đưa dữ liệu vào mảng $serviceData
    while ($row = $result2->fetch_assoc()) {
        $serviceData[] = [
            "service" => $row["servicename"],
            "usage_count" => (int)$row["usage_count"]
        ];
    }
}

// Trả về dữ liệu ở định dạng JSON cho cả doanh thu và dịch vụ
header('Content-Type: application/json');
echo json_encode([
    "revenueData" => $revenueData,
    "serviceData" => $serviceData
]);

$conn->close();
?>
