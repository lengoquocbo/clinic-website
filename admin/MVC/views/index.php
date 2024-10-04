<?php
// Kiểm tra xem có tham số mod và act được truyền qua URL không
$mod = isset($_GET['mod']) ? $_GET['mod'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';

// Hàm để tải nội dung của trang
function loadContent($mod, $act) {
    if ($mod === 'thuoc' && $act === 'list') {
        ob_start();
        include 'thuoc.php';
        return ob_get_clean();
    } else if($mod === 'thuoc' && $act ==='add'){
        
    } else if($mod === 'thuoc' && $act ==='delete'){
    } else if($mod === 'thuoc' && $act ==='edit'){
    } else if ($mod === 'nhanvien' && $act === 'list') {
        ob_start();
        include 'nhanvien.php';
        return ob_get_clean();
    } else if($mod === 'nhanvien' && $act ==='add'){
        
    } else if($mod === 'nhanvien' && $act ==='delete'){
    } else if($mod === 'nhanvien' && $act ==='edit'){
    }

    return ' <img src="https://media-cdn-v2.laodong.vn/storage/newsportal/2023/8/26/1233821/Giai-Nhi-1--Nang-Tre.jpg" alt="Hình ảnh">
';
}
define('BASE_URL', '/clinic-website/');

// Bắt đầu đầu ra HTML
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/styleglobal.css">
    <link rel="stylesheet" href="/../clinic-website/assets/css/styleglobal.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Vinmeclatest xin chào</title>
    <style>
       body,
body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    box-sizing: border-box;
    font-family: var(--default-font);
}

.container {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.header {
    height: 50px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    background-color: var(--color-accent);
}


.header .logo {
    font-size: 32px;
    font-weight: bold;
    color: white;
}

.header .nav ul {
    list-style: none;
    display: flex;
    margin-right: -20px;
}

.header .nav ul li {
    font-size: 20px;
    border-radius: 5px;
    height: 50px;
    width: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.header .nav ul li:hover {
    background-color: #ffffff;
}

.header .nav ul li:hover a {
    color: var(--default-font);
}

.header .nav ul li a {
    text-decoration: none;
    color: #ffffff;
    transition: color 0.3s ease;
}


.menu_list_button {
    font-size: 24px;
    margin-left: 8px;
    cursor: pointer;
}

.menu_list_button_check {
    display: none;
}

.overlay {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: none;
}

.menu_list_button_check:checked~.overlay {
    display: block;
}

.menu {
    display: flex;
}

.menuleft {
    width: 320px;
    height: 100vh;
    background-color: var(--color-default);
    padding: 20px;
    transform: translateX(-100%);
    transition: transform 0.3s ease;
    position: fixed;
    top: 0px;
    left: 0;
}

.menu_list_button_check:checked~.menu .menuleft {
    transform: translateX(0);
}

.exit_menu_list {
    font-size: 24px;
    margin-left: 300px;
    cursor: pointer;
    color: #ffffff;
}

.menuleft-nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.menuleft-nav ul li a {
    display: flex;
    padding: 15px;
}

.menuleft-nav ul li a:hover {
    background-color: var(--color-accent);
    border-radius: 5px;
}

.menuleft-nav ul li a,
.menuleft-nav ul li button {
    text-decoration: none;
    color: #ffffff;
    background-color: var(--color-default);
    border-bottom: 1px solid #ccc;
    display: block;
    text-align: left;
    cursor: pointer;

}

.menuleft-nav i {
    margin-right: 10px;
    font-size: 20px;
    vertical-align: middle;
    color: #ffffff;

}

.menuleft-nav ul li button {
    padding: 15px;
    width: 100%;
    text-align: center;
    background-color: var(--color-button);
    font-size: 14px;
    color: white;
    border-radius: 5px;
    outline: none;
    border: white;

}

.menuleft_button {
    margin-top: 50px;
}

.menuleft_button li button:hover {
    background-color: var(--color-success-text);
}

.tabbarright {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    text-align: center;
    height: 80vh;
}

.tabbarright img {
    width: 100%;
    height: 80vh;
    /* Thêm các thuộc tính sau nếu bạn muốn ảnh to hơn và có hiệu ứng bóng */
    /* hoặc kích thước mong muốn */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.footer {
    margin-top: auto;
    text-align: center;
    padding: 10px;
    background-color: #f1f1f1;
    border-top: 1px solid #ccc;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    color: #666;
    border: none;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="logo">Vinmeclatest</h1>
            <nav class="nav">
                <ul>
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="index.php?mod=thuoc&act=list">Thuốc</a></li>
                    <li><a href="#services">Dịch vụ</a></li>
                    <li><a href="#statistic">Thống kê</a></li>
                </ul>
            </nav>
        </div>

        <input type="checkbox" id="menu_list_check" class="menu_list_button_check">
        <label for="menu_list_check" class="menu_list_button"><i class='bx bx-menu'></i></label>
        <label for="menu_list_check" class="overlay"></label>

        <div class="menu">
            <div class="menuleft">
                <label for="menu_list_check" class="exit_menu_list"><i class='bx bx-x'></i></label>
                <nav class="menuleft-nav">
                   <ul>
                        <li>....</li>
                        <li><a href="#" id="lichhen"><i class='bx bx-calendar'></i> Lịch hẹn</a></li>
                        <li><a href=""><i class='bx bxs-heart'></i> Khám bệnh</a></li>
                        <li><a href=""><i class='bx bxs-duplicate'></i> Hồ sơ bệnh nhân</a></li>
                        <li><a href="index.php?mod=nhanvien&act=list"><i class='bx bxs-group'></i> Hồ sơ nhân viên</a></li>
                        <li><a href=""><i class='bx bxs-server'></i> Quản lí thiết bị</a></li>
                        <div class="menuleft_button">
                        <li><button><i class='bx bx-log-out'></i> Đăng xuất</button></li>
                        <li>....</li>
                        <li><button><i class='bx bx-revision'></i> Tải lại</button></li></div>
                   </ul>
                </nav>
            </div>
            <div id="tabbarright" class="tabbarright">
                <?php echo loadContent($mod, $act); ?>
            </div>
        </div>

        <div class="footer">
             <span>By quocbo - quanghuy  @ vku-23JIT | <?php echo date("d/m/Y"); ?></span>
         </div>
    </div>

    <script src="assets/js/admin.js"></script>
</body>
</html>