<?php
session_start();
require_once __DIR__ .'../../../../model/thuocmodel.php';
require_once __DIR__ .'../../../../model/dichvumodel.php';


$userviceID = $_POST['userviceID'] ?? null; // Đảm bảo nhận userviceID từ form hoặc session
$serviceID = $_POST['serviceID'] ?? null;   // Đảm bảo nhận serviceID từ form hoặc session

$serviceModel = new Services();
$allServices = $serviceModel->getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kê Thuốc</title>
    <link rel="stylesheet" href="../../../assets/css/styleglobal.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .form_container_around {
            display: flex;
            justify-items: center;
            align-items: center;
            padding: 20px;
        }

        .form_container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form_container select {
            border-radius: 4px;
            width: 300px;
            height: 30px;
            outline: none;
        }

        .medicine_list table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .medicine_list th,
        .medicine_list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .medicine_list th {
            background-color: #218838;
            color: white;
        }

        .add-to-cart {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            float: right;
            margin-left: 10px;
        }

        .add-to-cart:hover {
            background-color: #45a049;
        }

        input[type="number"] {
            width: 60px;
            padding: 5px;
        }

        .medicine_addcart {
            margin-top: 20px;
        }

        #cart-container {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        #cart-container h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .cart-table th,
        .cart-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .cart-table th {
            background-color: #218838;
            color: white;
        }

        .cart-table td {
            background-color: #ffffff;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item-name {
            flex: 2;
            font-weight: bold;
        }

        .cart-item-quantity,
        .cart-item-price {
            flex: 1;
            text-align: center;
        }

        .cart-total {
            font-weight: bold;
            text-align: right;
            padding-top: 10px;
            border-top: 1px solid #e0e0e0;
            margin-top: 10px;
            font-size: 18px;
            color: #333;
        }

        .empty-cart-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .empty-cart-btn:hover {
            background-color: #c0392b;
        }

        .remove-item {
            background-color: #ff5c33;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .remove-item:hover {
            background-color: #e60000;
        }

        .ketoa {
            width: 30%;
            color: white;
            height: 40px;
            text-align: center;
            background-color: #45a049;
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            border: #218838;
            margin-left: auto;
            margin-right: 20px;
        }

        .ketoa_container {
            display: flex;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="form_container_around">
        <div class="form_container">
            <div class="form_add_info">
                <h2>Kê Toa Thuốc</h2>

                <div>
                    <select id="serviceID" name="serviceID">
                        <?php foreach ($allServices as $service): ?>
                            <option value="<?= $service['serviceID'] ?>">
                                <?= htmlspecialchars($service['servicename']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="medicine_list" id="medicine-list-container">
                    <!-- Danh sách thuốc sẽ được load bằng AJAX -->
                </div>

                <div class="medicine_addcart">
                    <h3>Giỏ hàng</h3>
                    <button id="empty-cart" class="empty-cart-btn">Xóa giỏ hàng</button>
                    <div id="cart-container">
                        <!-- Giỏ hàng sẽ được load bằng AJAX -->
                    </div>
                    <div class="ketoa_container">
                        <button id="ketoa" class="ketoa">Kê Toa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            loadMedicineList();
            loadCart();

            $('#serviceID').change(function() {
                loadMedicineList();
            });

            $(document).on('click', '.add-to-cart', function() {
                const userviceID = Math.floor(Math.random() * 1000000);
                const medicineID = $(this).data('id');
                const quantity = $(this).closest('tr').find('input[name="quantity"]').val();
                const note = $(this).closest('tr').find('input[name="note"]').val();
                const usemedicineID = Math.floor(Math.random() * 1000000); // Tạo ngẫu nhiên usemedicineID (có thể tùy chỉnh)

                if (quantity <= 0 || isNaN(quantity)) {
                    alert('Vui lòng nhập số lượng hợp lệ');
                    return;
                }

                $.ajax({
                    url: '/clinic-website/admin/MVC/model/giohangmodel.php',
                    method: 'POST',
                    data: {
                        action: 'add',
                        usemedicineID: usemedicineID, // Thêm usemedicineID vào dữ liệu giỏ hàng
                        userviceID: userviceID,
                        medicineId: medicineID,
                        quantity: quantity,
                        note: note
                    },
                    success: function(response) {
                        if (response === 'success') {
                            console.log('Medicine ID:', medicineID, note);
                            loadCart();
                        } else {
                            alert('Có lỗi xảy ra. Vui lòng thử lại!');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra. Vui lòng thử lại!');
                    }
                });
            });

            $(document).on('click', '.remove-item', function() {
                const medicineID = $(this).data('id');

                $.ajax({
                    url: '/clinic-website/admin/MVC/model/giohangmodel.php',
                    method: 'POST',
                    data: {
                        action: 'remove',
                        medicineId: medicineID
                    },
                    success: function(response) {
                        if (response === 'success') {
                            loadCart();
                        } else {
                            alert('Có lỗi xảy ra. Vui lòng thử lại!');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra. Vui lòng thử lại!');
                    }
                });
            });

            $('#empty-cart').click(function() {
                $.ajax({
                    url: '/clinic-website/admin/MVC/model/giohangmodel.php',
                    method: 'POST',
                    data: {
                        action: 'empty'
                    },
                    success: function(response) {
                        if (response === 'success') {
                            loadCart();
                        } else {
                            alert('Có lỗi xảy ra. Vui lòng thử lại!');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra. Vui lòng thử lại!');
                    }
                });
            });

            function loadMedicineList() {
                const serviceID = $('#serviceID').val();
                $.ajax({
                    url: '/clinic-website/admin/MVC/views/khambenh/kethuoc/thuocbyid.php',
                    method: 'POST',
                    data: {
                        serviceID: serviceID
                    },
                    success: function(response) {
                        $('#medicine-list-container').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }

            function loadCart() {
                $.ajax({
                    url: '/clinic-website/admin/MVC/views/khambenh/kethuoc/load_cart.php',
                    method: 'GET',
                    success: function(response) {
                        $('#cart-container').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading cart:', error);
                    }
                });
            }
            $('#ketoa').click(function() {
                // Lấy dữ liệu giỏ hàng từ session
                $.ajax({
                    url: '/clinic-website/admin/MVC/model/giohangmodel.php',
                    method: 'POST',
                    data: {
                        action: 'getCart'
                    },
                    success: function(response) {
                        if (response) {
                            const cartData = JSON.parse(response);
                            console.log('cartData:', cartData);

                            if (cartData.length > 0) {
                                // Thực hiện gọi AJAX để lưu đơn thuốc vào cơ sở dữ liệu
                                $.ajax({
                                    url: '/clinic-website/admin/MVC/model/giohangmodel.php',
                                    method: 'POST',
                                    data: {
                                        action: 'ketoa',
                                        cartData: JSON.stringify(cartData),
                                        userviceID: <?php echo json_encode($userviceID); ?>,
                                        serviceID: <?php echo json_encode($serviceID); ?>
                                    },
                                    success: function(response) {
                                        console.log('Response from ketoa:', response);
                                        if (response === 'success') {
                                            alert('Kê toa thành công!');
                                            emptycart();
                                            setTimeout(function() {
                                                window.location.href = 'index.php?mod=lichhen&act=list';
                                            }, 500);
                                        } else {
                                            alert('Có lỗi xảy ra. Vui lòng thử lại!');
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error:', error);
                                        alert('Có lỗi xảy ra. Vui lòng thử lại!');
                                    }
                                });
                            } else {
                                alert('Giỏ hàng trống. Vui lòng thêm thuốc vào giỏ!');
                            }
                        } else {
                            alert('Có lỗi xảy ra khi lấy dữ liệu giỏ hàng!');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi lấy dữ liệu giỏ hàng!');
                    }
                });
            });
            function emptycart() {
                $.ajax({
                    url: '/clinic-website/admin/MVC/model/giohangmodel.php',
                    method: 'POST',
                    data: {
                        action: 'empty'
                    },
                    success: function(response) {
                        if (response === 'success') {
                            loadCart();
                        } else {
                            alert('Có lỗi xảy ra. Vui lòng thử lại!');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra. Vui lòng thử lại!');
                    }
                });

            }
        });
    </script>
</body>

</html>
