<?php
$mod = isset($_GET['mod']) ? $_GET['mod'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';



// Hàm để tải nội dung của trang
function loadContentdichvu($mod, $act)
{
    if ($mod === 'dichvu' && $act === 'edit') {
        ob_start();
        include 'suadichvu.php';
        return ob_get_clean();
    } elseif ($mod === 'dichvu' && $act === 'add') {
        ob_start();
        include 'themdichvu.php';
        return ob_get_clean();
    } elseif ($mod === 'dichvu' && $act === 'delete') {
        //xử lý xóa
    }
}
$content = loadContentdichvu($mod, $act);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/clinic-website/assets/css/main.css">
    <style>
        
    </style>
</head>

<body>
    <?php  require_once __DIR__ . '/../../model/dichvumodel.php'; ?>
    <div class="around">

        <div class="table_container">
            <h2 class="dichvu-list__title">Danh sách dịch vụ</h2>

            <?php if (isset($_COOKIE['msg'])) { ?>
                <div class="alert alert--success">
                    <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
                </div>
            <?php } ?>

            <!-- Nút thêm dịch vụ (hiển thị mà không cần quyền admin) -->
            <a href="index.php?mod=dichvu&act=add"><button class="dichvu-list__add-btn">Thêm dịch vụ mới</button></a>

            <!-- Bảng có thanh cuộn -->
            <div class="table_wrapper">
                <table class="table">
                    <tr>
                        <th>Mã dịch vụ</th>
                        <th>Mã nhân viên</th>
                        <th>Tên dịch vụ</th>
                        <th>Giá</th>
                        <th>Mô tả</th>
                        <th>Thao tác</th>
                    </tr>
                    <?php
                    
                    $dichvumodel = new Services();
                    $dichvu_list = $dichvumodel->getALL();
                    foreach ($dichvu_list as $dichvu) { ?>
                        <tr>
                            <td><?= $dichvu['serviceID'] ?></td>
                            <td><?= $dichvu['staffID'] ?></td>
                            <td><?= $dichvu['servicename'] ?></td>
                            <td><?= number_format($dichvu['price'], 0, ',', '.') ?> VNĐ</td>
                            <td><?= $dichvu['description'] ?></td>
                            <td>
                                <a href="index.php?mod=dichvu&act=edit&id=<?= $dichvu['serviceID'] ?>" class="dichvu-list__action-btn">Sửa</a>
                                <a href="index.php?mod=dichvu&act=delete&id=<?= $dichvu['serviceID'] ?>" onclick='return confirm("Bạn có chắc muốn xóa dịch vụ này?")' class="dichvu-list__action-btn">Xóa</a>
                            </td>
                        </tr>
                    <?php
                  } ?>
                </table>
            </div>
        </div>
    </div>


</body>

</html>