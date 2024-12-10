<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Lịch Hẹn</title>
    <style>
        .table_container {
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 90%;
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
            text-decoration: none;
            margin-left: auto;
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

        .btn {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 20px;
        }
        .select-div{
            height: 30px;
            border-radius: 5px;
        }
        .loc{
            padding: 6px 12px;
            margin: 2px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            text-align: center; 
        }
    </style>
</head>

<body>
    <div class="table_container">
        <h2 class="medicine-list__title">Danh Sách Lịch Hẹn</h2>

        <div class="btn">
        <select class="select-div" name="confirm" id="confirm">
        <option value="0">CHƯA DUYỆT</option>
        <option value="1">ĐÃ DUYỆT</option>
    </select>
    <input class="select-div" type="date" id="filter-date" value="<?= date('Y-m-d') ?>">
    <a href="#" class="loc" id="filter-btn">Lọc</a>
            <a href="index.php?mod=lichhen&act=add" class="medicine-list__add-btn">Khám trực tiếp</a>
        </div>

        <div class="table_wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Thứ tự</th>
                        <th>Họ và tên</th>
                        <th>Ngày giờ đặt</th>
                        <th>Số điện thoại</th>
                        <th>Dịch vụ</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody id="appointment-body">
                    <!-- Nội dung sẽ được cập nhật bằng AJAX -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
    document.getElementById('filter-btn').addEventListener('click', function () {
    const confirmStatus = document.getElementById('confirm').value;
    const selectedDate = document.getElementById('filter-date').value;

    const [year, month, day] = selectedDate.split('-');

    // Gửi request đến server với confirm và ngày đã chọn
    fetch(`/admin/MVC/views/danhsachlichhen.php?confirm=${confirmStatus}&day=${day}&month=${month}&year=${year}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('appointment-body').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
});

    </script>
</body>

</html>
