<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../clinic-website/assets/css/styleglobal.css">
    <title>Danh sách thuốc</title>
    <style>
        body {
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .medicine-list__title {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .medicine-list__add-btn {
            background-color: #0056b3;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 20px;
            display: block;
            margin-left: auto;
        }

        .medicine-list__add-btn:hover {
            background-color: #003d82;
        }

        .medicine-list__table-container {
            margin-left: 120px;
            margin-right: 30px;
            height: 300px;
            overflow-x: auto;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE and Edge */
            overflow-y: auto;
            width: 80%;
            padding: 20px;
            flex-grow: 1;
            /* Đảm bảo bảng chiếm đầy không gian còn lại của container */
                }

        .medicine-list__table-container::-webkit-scrollbar {
            display: none;
            /* Ẩn thanh cuộn cho Chrome, Safari */
        }

        .medicine-list__table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        .medicine-list__table th,
        .medicine-list__table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .medicine-list__table th {
            background-color: #218838;
            color: white;
            font-weight: bold;
        }

        .medicine-list__table tr:hover {
            background-color: #f5f5f5;
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

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert--success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Bảng danh sách thuốc -->
        <div class="medicine-list__table-container">
            <table class="medicine-list__table">
                <thead>
                    <tr>
                        <h2 class="medicine-list__title">Danh sách thuốc</h2>
                    </tr>

                    <!-- Thông báo -->
                    <tr>
                        <?php
                        if (isset($_COOKIE['msg'])) {
                        ?>
                            <div class="alert alert--success">
                                <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
                            </div>
                        <?php
                        }
                        ?>

                        <!-- Nút thêm thuốc (hiển thị mà không cần quyền admin) -->
                        <button onclick="location.href='themthuoc.php'" class="medicine-list__add-btn">Thêm thuốc</button>
                    </tr>

                    <tr>
                        <th>ID</th>
                        <th>Tên thuốc</th>
                        <th>Giá (VNĐ)</th>
                        <th>Chức năng</th>
                        <th>Thao tác</th> <!-- Cột thao tác luôn hiển thị -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../model/thuocmodel.php';

                    $medicineModel = new Medicine();
                    $thuoc_list = $medicineModel->getAll();

                    foreach ($thuoc_list as $thuoc) { ?>
                        <tr>
                            <td><?= $thuoc['medicineID'] ?></td>
                            <td><?= $thuoc['name'] ?></td>
                            <td><?= number_format($thuoc['price'], 0, ',', '.') ?></td>
                            <td><?= $thuoc['function'] ?></td>
                            <!-- Thao tác Sửa và Xóa luôn hiển thị -->
                            <td>
                                <a href='suathuoc.php?id=<?= $thuoc['medicineID'] ?>' class="medicine-list__action-btn">Sửa</a>
                                <a href='xoathuoc.php?id=<?= $thuoc['medicineID'] ?>' onclick='return confirm("Bạn có chắc muốn xóa thuốc này?")' class="medicine-list__action-btn">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>