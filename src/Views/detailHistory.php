<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Hồ Sơ Bệnh Nhân</title>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --background-color: #f4f6f7;
            --text-color: #2c3e50;
            --border-radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--background-color);
            line-height: 1.6;
            color: var(--text-color);
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 1rem;
        }

        .patient-card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .patient-header {
            background-color: #2c3e50;
            color: white;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .patient-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .patient-content {
            display: flex;
            padding: 2rem;
            gap: 2rem;
        }

        .patient-section {
            flex: 1;
            background-color: #f9f9f9;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .patient-section h2 {
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .info-row {
            display: flex;
            margin-bottom: 0.75rem;
        }

        .info-row label {
            font-weight: 600;
            width: 150px;
            color: var(--text-color);
        }

        .info-row span {
            color: #6c757d;
        }

        .medicine-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            max-height: 9rem; /* Giới hạn chiều cao của bảng không quá 3 hàng */
            overflow-y: auto; 
        }

        .medicine-table th {
            background-color: #2c3e50;
            color: white;
            padding: 0.75rem;
            text-align: left;
        }

        .medicine-table td {
            padding: 0.5rem 0.75rem;
            border-bottom: 1px solid #e9ecef;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            padding: 1rem;
            background-color: #f1f3f4;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-back {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-edit {
            background-color: #f39c12;
            color: white;
        }

        .btn-print {
            background-color: var(--secondary-color);
            color: white;
        }
        @media (max-width: 768px) {
            .container {
                max-width: 100%;
                margin: 1rem;
                padding: 0.5rem;
            }
            .patient-header {
                padding: 1rem;
            }
            .patient-header h1 {
                font-size: 1.25rem;
            }
            .patient-content {
                flex-direction: column;
            }
            .patient-section {
                flex-basis: auto;
            }
            .medicine-table {
                font-size: 0.9rem;
            }
            .medicine-table th,
            .medicine-table td {
                padding: 0.5rem;
            }
            .action-buttons {
                flex-direction: column;
                align-items: flex-end;
            }
            .btn {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="patient-card">
            <div class="patient-header">
                <h1>Hồ Sơ Bệnh Nhân: <?php echo $dt['tenbenhnhan']; ?></h1>
            </div>

            <div class="patient-content">
                <div class="patient-section">
                    <h2>Thông Tin Cá Nhân</h2>
                    <div class="info-row">
                        <label>Họ và Tên:</label>
                        <span><?php echo $dt['tenbenhnhan']; ?></span>
                    </div>
                    <div class="info-row">
                        <label>Giới Tính:</label>
                        <span><?php echo $dt['sex']; ?></span>
                    </div>
                    <div class="info-row">
                        <label>Ngày Sinh:</label>
                        <span><?php echo $dt['ngaysinh']; ?></span>
                    </div>
                    <div class="info-row">
                        <label>Số Điện Thoại:</label>
                        <span><?php echo $dt['phone']; ?></span>
                    </div>
                    <div class="info-row">
                        <label>Địa Chỉ:</label>
                        <span><?php echo $dt['address']; ?></span>
                    </div>
                </div>

                <div class="patient-section">
                    <h2>Thông Tin Khám Bệnh</h2>
                    <div class="info-row">
                        <label>Bác Sĩ:</label>
                        <span><?php echo $dt['tennhanvien']; ?></span>
                    </div>
                    <div class="info-row">
                        <label>Ngày Khám:</label>
                        <span><?php echo $dt['ngaykham']; ?></span>
                    </div>
                    <div class="info-row">
                        <label>Dịch Vụ:</label>
                        <span><?php echo $dt['dichvu']; ?></span>
                    </div>
                    <div class="info-row">
                        <label>Chẩn Đoán:</label>
                        <span><?php echo $dt['chuandoan']; ?></span>
                    </div>

                    <h2>Phương Pháp Điều Trị</h2>
                    <table class="medicine-table">
                        <thead>
                            <tr>
                                <th>Tên Thuốc</th>
                                <th>Số Lượng</th>
                                <th>Liều Lượng</th>
                            </tr>
                        </thead>
                        <?php if (!empty($medicineList)): ?>
                                <?php foreach ($medicineList as $medicine): ?>
                                    <tr>
                                        <td><?php echo $medicine['tenthuoc']; ?></td>
                                        <td><?php echo $medicine['soluong']; ?></td>
                                        <td><?php echo $medicine['ghichu'];?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">Không có thông tin thuốc</td>
                                </tr>
                            <?php endif; ?>
                    </table>
                </div>
            </div>

            <div class="action-buttons">
                <a href="?mod=taikhoan&act=history" class="btn btn-back">Quay Lại</a>
            </div>
        </div>
    </div>
</body>