<?php
session_start();
require_once 'connectdb.php';
$db = Database::getInstance()->getConection();

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'add' && isset($_POST['medicineId']) && isset($_POST['quantity']) && isset($_POST['usemedicineID']) && isset($_POST['userviceID'])) {
        $usemedicineID = $_POST['usemedicineID'];
        $userviceID = $_POST['userviceID'];
        $medicineId = $_POST['medicineId'];
        $quantity = (int)$_POST['quantity'];
       

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Thêm hoặc cập nhật số lượng trong giỏ hàng
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['medicineId'] == $medicineId) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][] = [
                'usemedicineID' => $usemedicineID,
                'userviceID' => $userviceID,
                'medicineId' => $medicineId,
                'quantity' => $quantity
            ];
        }

        echo 'success';
    } else if ($_POST['action'] === 'remove' && isset($_POST['medicineId'])) {
        $medicineId = $_POST['medicineId'];
        
        // Loại bỏ các lệnh var_dump để tránh thêm chuỗi vào phản hồi
        // var_dump("Medicine ID from AJAX:", $medicineId);
        // var_dump("Current Cart:", $_SESSION['cart']);
    
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['medicineId'] == $medicineId) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); // Reset lại các chỉ số trong mảng
                echo 'success';
                exit; // Dừng script sau khi xóa thành công
            }
        }
    
        // Nếu không tìm thấy sản phẩm cần xóa
        echo 'error: Item not found';
        exit;
    }
     elseif ($_POST['action'] === 'empty') {
        unset($_SESSION['cart']);
        echo 'success';
    } elseif ($_POST['action'] === 'getCart') {
        if (isset($_SESSION['cart'])) {
            echo json_encode($_SESSION['cart']);
        } else {
            echo json_encode([]);
        }
    } elseif ($_POST['action'] === 'ketoa') {
        $cartData = json_decode($_POST['cartData'], true);
        if (!$cartData) {
            echo 'error: Invalid cart data';
            exit;
        }
    
        foreach ($cartData as $item) {
            $usemedicineID = $item['usemedicineID'];
            $userviceID = $item['userviceID'];
            $medicineID = $item['medicineId'];
            $quantity = $item['quantity'];
            $totalprice = isset($item['totalprice']) ? $item['totalprice'] : 0;
    
            // Nếu `totalprice` không hợp lệ, tính toán nó từ `quantity` và `medicineID`
            if ($totalprice <= 0) {
                $query_price = "SELECT price FROM medicines WHERE medicineID = ?";
                $stmt_price = $db->prepare($query_price);
                $stmt_price->bind_param("s", $medicineID);
                $stmt_price->execute();
                $result = $stmt_price->get_result();
                if ($priceRow = $result->fetch_assoc()) {
                    $price = $priceRow['price'];
                    $totalprice = $price * $quantity;
                } else {
                    echo 'error: Unable to fetch price';
                    exit;
                }
                $stmt_price->close();
            }
    
            // Thêm thuốc vào bảng `usemedicines`
            $query = "INSERT INTO usemedicines (usemedicineID, userviceID, medicineID, quantity, totalprice) VALUES (?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            if (!$stmt) {
                echo 'error: Unable to prepare statement';
                exit;
            }
            $stmt->bind_param("sssss", $usemedicineID, $userviceID, $medicineID, $quantity, $totalprice);
            if (!$stmt->execute()) {
                echo 'error: Unable to prepare statement - ' . $db->error;
                exit;
            }
    
            // Cập nhật số lượng tồn kho của thuốc trong bảng `medicines`
            $query_update_quantity = "UPDATE medicines SET quantity = quantity - ? WHERE medicineID = ?";
            $stmt_update = $db->prepare($query_update_quantity);
            if (!$stmt_update) {
                echo 'error: Unable to prepare update statement';
                exit;
            }
            $stmt_update->bind_param("is", $quantity, $medicineID);
            if (!$stmt_update->execute()) {
                echo 'error: Unable to update quantity in medicines';
                exit;
            }
            $stmt_update->close();
        }
    
        echo 'success';
    }
    
    
    
} else {
    echo 'error';
}
