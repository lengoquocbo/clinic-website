<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bệnh nhân</title>
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
            height: 30px;
            text-decoration: none;
            width: 150px;
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

        .search_patient input {
            width: 25%;
            border-radius: 4px;
            height: 40px;
            outline: none;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="around">

        <div class="table_container">
            <h2 class="medicine-list__title">Danh sách bệnh nhân </h2>

            <?php if (isset($_COOKIE['msg'])) { ?>
                <div class="alert alert--success">
                    <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
                </div>
            <?php } ?>

            <div class="search_patient">
                <input type="search" name="patientName" id="patientName" placeholder="Tìm kiếm bệnh nhân..." onkeyup="searchPatient()" />
            </div>

            <script>
                function searchPatient() {
                    const name = document.getElementById("patientName").value;

                    const xhr = new XMLHttpRequest();
                    xhr.open("GET", "/clinic-website/admin/MVC/views/benhnhan/timkiembenhnhan.php?name=" + encodeURIComponent(name), true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            console.log(xhr.responseText); // Kiểm tra phản hồi
                            document.getElementById("patientTableBody").innerHTML = xhr.responseText;
                        } 
                    };
                    xhr.send();
                }
            </script>


            <div class="table_wrapper">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Họ và tên</th>
                        <th>Sinh nhật</th>
                        <th>Giới tính</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Thao tác</th>
                    </tr>
                    <tbody id="patientTableBody">
                        <?php
                        require_once __DIR__ . '../../../model/benhnhanmodel.php';
                        $benhnhanmodel = new benhnhan();
                        $benhnhan_list = $benhnhanmodel->getALL();
                        foreach ($benhnhan_list as $benhnhan) { ?> <tr>
                                <td><?= $benhnhan['patientID'] ?></td>
                                <td><?= $benhnhan['fullname'] ?></td>
                                <td><?= $benhnhan['birthdate'] ?></td>
                                <td><?= $benhnhan['sex'] ?></td>
                                <td><?= $benhnhan['phone'] ?></td>
                                <td><?= $benhnhan['address'] ?></td>
                                <td>
                                    <a style="background-color: ;" href="index.php?mod=benhnhan&act=see&id=<?= $benhnhan['patientID'] ?>" class="medicine-list__action-btn">Xem</a>
                                    <a style="background-color:#f6c23e ;" href="index.php?mod=benhnhan&act=edit&id=<?= $benhnhan['patientID'] ?>" class="medicine-list__action-btn">Sửa</a>
                                    <a style="background-color:#e74a3b ;" href="index.php?mod=benhnhan&act=delete&id=<?= $benhnhan['patientID'] ?>" onclick="return confirm('Bạn có chắc muốn xóa người này?')" class="medicine-list__action-btn">Xóa</a>
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