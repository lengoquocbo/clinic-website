<?php
session_start();
require_once __DIR__ .'../../../../model/thuocmodel.php';


if (isset($_POST['serviceID'])) {
    $serviceID = $_POST['serviceID'];
    $thuoc = new Medicine();
    $thuoc_list = $thuoc->getbyServiceID($serviceID);

    echo '<table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên thuốc</th>
                    <th>Chức năng</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Chọn</th>
                </tr>
            </thead>
            <tbody>';

    foreach ($thuoc_list as $item) {
        echo '<tr>
                <td>' . htmlspecialchars($item['medicineID']) . '</td>
                <td>' . htmlspecialchars($item['name']) . '</td>
                <td>' . htmlspecialchars($item['function']) . '</td>
                <td>' . (int)$item['quantity'] . '</td>
                <td>' . number_format($item['price']) . ' VND</td>
                <td>' . htmlspecialchars($item['status']) . '</td>

                <td>
                    <input style="height: 30px; border-radius: 4px;" type="text" name="note" value="sáng và tối (1 buổi/ 1 viên)- Sau khi ăn" class="quantity-input">
                    <input style=" border-radius: 4px;" type="number" name="quantity" value="1" min="1" class="quantity-input">
                    <button class="add-to-cart" name="add-to-cart" data-id="' . htmlspecialchars($item['medicineID']) . '">
                        Thêm vào toa
                    </button>
                </td>
            </tr>';
    }

    echo '</tbody></table>';
}
