
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .table_container {
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            margin-top: 30px;

        }

        .table_wrapper {
            max-height: 400px;
            overflow-y: auto;
            overflow-x: auto;
        }

        .table_wrapper::-webkit-scrollbar {
            display: none;
            /* Ẩn thanh cuộn cho Chrome, Safari */
        }

        .table {
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
            margin-bottom: 20px;
            display: block;
            height: 25px;
            text-decoration: none;
            width: 80px;
        }
        
            


        .table th,
        .table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #218838;
            color: white;
            font-weight: bold;
        }

        .table tr:hover {
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
            <h2 class="medicine-list__title">Danh sách nhân viên</h2>

            <?php if (isset($_COOKIE['msg'])) { ?>
                <div class="alert alert--success">
                    <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
                </div>
            <?php } ?>


            <a href="index.php?mod=nguoidung&act=add" class="medicine-list__add-btn">Thêm Mới</a>

            <!-- Bảng có thanh cuộn -->
            <div class="table_wrapper">
                <table class="table">
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Vai trò</th>
                        <th>Thao tác</th>
                    </tr>
                    <?php
                    require_once __DIR__ . '/../../model/nguoidungmodel.php';
                    $nguoidung = new Nguoidung();
                    $nguoidunglist = $nguoidung->getALL();
                    foreach ($nguoidunglist as $nguoidung) { ?>
                        <tr>
                            <td><?= $nguoidung['username'] ?></td>
                            <td><?= $nguoidung['mail'] ?></td>
                            <td><?= $nguoidung['phone'] ?></td>
                            <td><?= $nguoidung['role'] ?></td>
                            <td>
                                <a style="background-color: red;" href='index.php?mod=nguoidung&act=delete&id=<?= $nguoidung['userID'] ?>' onclick='return confirm("Bạn có chắc muốn xóa tài khoản này?")' class="medicine-list__action-btn">Xóa</a>
                            </td>
                        </tr>
                    <?php  } ?>
                </table>
            </div>
        </div>
    </div>


</body>

</html>