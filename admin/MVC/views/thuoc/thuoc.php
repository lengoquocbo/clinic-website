<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách thuốc</title>
    <style>
      
        .table_container {
            margin: 0 auto;
            background-color: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            border-radius: 8px;
            margin-top: 30px;
         
        }
        .medicine-list__table-container {
            max-height: 400px;
            overflow-y: auto;
            overflow-x: auto;
            padding: 20px;
         

        }

        .medicine-list__table-container::-webkit-scrollbar {
            display: none;
            /* Ẩn thanh cuộn cho Chrome, Safari */
        }

        .medicine-list__table {
            width: 100%;
            border-collapse: collapse;

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
            margin-bottom: 10px;
            display: block;
            margin-right: 20px;
            width: 90px;
            text-decoration: none;
            margin-left: 20px;
        }

        .medicine-list__add-btn:hover {
            background-color: #003d82;
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
    <div class="around">
    <div class="table_container">
        <h2 class="medicine-list__title">Danh sách thuốc</h2>

        <!-- Thông báo -->
        <?php if (isset($_COOKIE['msg'])) { ?>
            <div class="alert alert--success">
                <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
            </div>
        <?php } ?>

        <!-- Nút thêm thuốc -->
        <a href="index.php?mod=thuoc&act=add" class="medicine-list__add-btn">Thêm Thuốc</a>

        <!-- Bảng danh sách thuốc -->
        <div class="medicine-list__table-container">
            <table class="medicine-list__table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên thuốc</th>
                        <th>Giá (VNĐ)</th>
                        <th>Chức năng</th>
                        <th>Số lượng</th>
                        <th>Thao tác</th>
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
                            <td><?= number_format($thuoc['price'], 0, ',', '.') ?> VNĐ</td>
                            <td><?= $thuoc['function'] ?></td>
                            <td><?= $thuoc['quantity'] ?></td>
                            <td>
                                <a href='index.php?mod=thuoc&act=edit&id=<?= $thuoc['medicineID'] ?>' class="medicine-list__action-btn">Sửa</a>
                                <a href='index.php?mod=thuoc&act=delete&id=<?= $thuoc['medicineID'] ?>' onclick='return confirm("Bạn có chắc muốn xóa thuốc này?")' class="medicine-list__action-btn">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</body>

</html>