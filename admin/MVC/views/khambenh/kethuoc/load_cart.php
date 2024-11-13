<?php
session_start();
require_once __DIR__ .'../../../../model/thuocmodel.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $thuoc = new Medicine();
    echo '<table class="cart-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên thuốc</th>
                    <th>Số lượng</th>
                    <th>Ghi chú</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                    <th>Service ID</th>
                    <th>UseMedicine ID</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>';

    $totalAmount = 0;
    foreach ($_SESSION['cart'] as $key => $cartItem) {
        $medicineID = $cartItem['medicineId']; // Lấy medicineID từ mỗi mục

        // Lấy thông tin thuốc từ cơ sở dữ liệu
        $medicine = $thuoc->getById($medicineID);

        // Kiểm tra nếu thuốc tồn tại trong cơ sở dữ liệu
        if ($medicine) {
            $quantity = $cartItem['quantity'];
            $note= $cartItem['note'];
            $userviceID = $cartItem['userviceID'];
            $usemedicineID = $cartItem['usemedicineID'];
            $subtotal = $medicine['price'] * $quantity;
            $totalAmount += $subtotal;

            echo '<tr>
                    <td>' . htmlspecialchars($medicine['medicineID']) . '</td>
                    <td>' . htmlspecialchars($medicine['name']) . '</td>
                    <td>' . (int)$quantity . '</td>
                    <td>' . htmlspecialchars($note) . '</td>
                    <td>' . number_format($medicine['price']) . ' VND</td>
                    <td>' . number_format($subtotal) . ' VND</td>
                    <td>' . htmlspecialchars($userviceID) . '</td>
                    <td>' . htmlspecialchars($usemedicineID) . '</td>
                    <td>
                        <button class="remove-item" data-id="' . htmlspecialchars($medicineID) . '">Xóa</button>
                    </td>
                </tr>';
        } else {
            echo '<tr>
                    <td colspan="7">Thuốc với ID ' . htmlspecialchars($medicineID) . ' không tồn tại.</td>
                </tr>';
        }
    }

    echo '</tbody>
          <tfoot>
            <tr>
                <td colspan="4">Tổng cộng:</td>
                <td colspan="3">' . number_format($totalAmount) . ' VND</td>
            </tr>
          </tfoot>
        </table>';
} else {
    echo '<p>Giỏ hàng trống</p>';
}
?>
