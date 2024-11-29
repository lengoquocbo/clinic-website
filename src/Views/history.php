
<head>
    <meta charset="UTF-8">
    <title>Hồ Sơ Bệnh Án</title>
    <style>
        .medical-records-container {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 20px;
            height: 100vh;

        }

        .records-table {
            width: 100%;
            border-collapse: collapse;
        }

        .records-table thead {
            background-color: #2c3e50;
            color: white;
        }

        .records-table th, 
        .records-table td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .records-table th {
            text-transform: uppercase;
            font-size: 0.9em;
        }

        .records-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .records-table tr:hover {
            background-color: #e8f4f8;
            transition: background-color 0.3s ease;
        }

        .status-completed {
            color: green;
            font-weight: bold;
        }

        .status-pending {
            color: orange;
            font-weight: bold;
        }

        .action-btn {
            /* Cơ bản về nút */
            display: inline-block;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            
            /* Màu sắc */
            background-color: #3498db;
            color: white;
            
            /* Kiểu chữ */
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            
            /* Hiệu ứng chuyển động */
            transition: 
                background-color 0.3s ease,
                transform 0.3s ease,
                box-shadow 0.3s ease;
            
            /* Tương tác */
            cursor: pointer;
            user-select: none;
        }

        .action-btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .action-btn:active {
            transform: translateY(1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        @media screen and (max-width: 768px) {
            .records-table thead {
                display: none;
            }

            .records-table tr {
                display: block;
                margin-bottom: 10px;
                border: 1px solid #ddd;
            }

            .records-table td {
                display: block;
                text-align: right;
                border-bottom: none;
            }

            .records-table td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>
    <div class="medical-records-container">
        <table class="records-table">
            <thead>
                <tr>
                    <th>Mã Hồ Sơ</th>
                    <th>Ngày Khám</th>
                    <th>Bác Sĩ</th>
                    <th>Chẩn Đoán</th>
                    <th>Trạng Thái</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                if(!empty($User) && is_array($User)) {
                    foreach ($User as $data) { ?>
                    <tr>
                        <td data-label="Mã Hồ Sơ"><?php echo $data['mahoso']; ?></td>
                        <td data-label="Ngày Khám"><?php echo $data['ngaykham'] ?></td>
                        <td data-label="Bác Sĩ"><?php echo $data['tennhanvien'] ?></td>
                        <td data-label="Chẩn Đoán"><?php echo $data['chuandoan'] ?></td>
                        <td data-label="Trạng Thái" class="status-completed">Đã Khám</td>
                        <td>
                            <a href="?mod=taikhoan&act=detail&id=<?php echo $data['mahoso']; ?>" class="action-btn">Xem chi tiết</a>
                        </td>
                    </tr>
                    <?php 
                    }
                } else {
                    echo "Không có dữ liệu";
                }
                ?>
                </tbody>
        </table>
    </div>
</body>
</html>