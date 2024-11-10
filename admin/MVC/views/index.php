<?php
$mod = isset($_GET['mod']) ? $_GET['mod'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';


// Hàm để tải nội dung của trang
function loadContent($mod, $act)
{
    if ($mod === 'thuoc' && $act === 'list') {
        ob_start();
        include '../views/thuoc/thuoc.php';
        return ob_get_clean();
    } elseif ($mod === 'thuoc' && $act === 'add') {
        ob_start();
        include '../views/thuoc/themthuoc.php';
        return ob_get_clean();
    } elseif ($mod === 'thuoc' && $act === 'delete') {
        ob_start();
        include '../views/thuoc/xoathuoc.php';
        return ob_get_clean();
    } elseif ($mod === 'thuoc' && $act === 'edit') {
        ob_start();
        include '../views/thuoc/suathuoc.php';
        return ob_get_clean();
    } elseif ($mod === 'thuoc' && $act === 'ketoa') {
        ob_start();
        include '../views/khambenh/kethuoc/themkethuoc.php';
        return ob_get_clean();


        //Nhân Viên

    } elseif ($mod === 'nhanvien' && $act === 'list') {
        ob_start();
        include '../views/nhanvien/nhanvien.php';
        return ob_get_clean();
    } elseif ($mod === 'nhanvien' && $act === 'add') {
        ob_start();
        include '../views/nhanvien/themnhanvien.php';
        return ob_get_clean();
    } elseif ($mod === 'nhanvien' && $act === 'delete') {
        ob_start();
        include '../views/nhanvien/xoanhanvien.php';
        return ob_get_clean();
    } elseif ($mod === 'nhanvien' && $act === 'edit') {
        ob_start();
        include '../views/nhanvien/suanhanvien.php';
        return ob_get_clean();
    }
    // dịch vụ 
    elseif ($mod === 'dichvu' && $act === 'edit') {
        ob_start();
        include '../views/dichvu/suadichvu.php';
        return ob_get_clean();
        # code...
    } elseif ($mod === 'dichvu' && $act === 'list') {
        # code...
        ob_start();
        include '../views/dichvu/dichvu.php';
        return ob_get_clean();
    } elseif ($mod === 'dichvu' && $act === 'delete') {
        # code...
        ob_start();
        include '../views/dichvu/xoadichvu.php';
        return ob_get_clean();
    } elseif ($mod === 'dichvu' && $act === 'add') {
        # code...
        ob_start();
        include '../views/dichvu/themdichvu.php';
        return ob_get_clean();
    } elseif ($mod === 'thietbi') {
        ob_start();
        include '../views/thietbi.php';
        return ob_get_clean();
    }
    // khám bệnh 
    else if ($mod === 'lichhen' && $act === 'list') {
        ob_start();
        include '../views/lichhen.php';
        return ob_get_clean();
    } else if ($mod === 'lichhen' && $act === 'add') {
        ob_start();
        include '../views/khambenh/themkhambenh.php';
        return ob_get_clean();
    } else if ($mod === 'lichhen' && $act === 'xacnhan') {
        ob_start();
        include '../views/khambenh/khambenh.php';
        return ob_get_clean();
    } else if ($mod === 'lichhen' && $act === 'cancel') {
        ob_start();
        include '../views/khambenh.php';
        return ob_get_clean();
    } else if ($mod === 'khambenh' && $act === 'kethuoc'){
       ob_start();
       include '../views/khambenh/kethuoc/kethuoc.php';
       return ob_get_clean();
    }
    else if ($mod === 'benhnhan' && $act === 'list'){
        ob_start();
        include '../views/benhnhan/benhnhan.php';
        return ob_get_clean();
    }
    else if ($mod === 'benhnhan' && $act === 'delete'){
        ob_start();
        include '../views/benhnhan/xoabenhnhan.php';
        return ob_get_clean();
    }else if ($mod === 'benhnhan' && $act === 'see'){
        ob_start();
        include '../views/benhnhan/xembenhnhan.php';
        return ob_get_clean();
    }
     else {
        ob_start();
        include 'home.php';
        return ob_get_clean();
    }
}

// Lấy nội dung trang dựa trên mod và act
$content = loadContent($mod, $act);

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../clinic-website/assets/css/styleglobal.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Vinmeclatest xin chào</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            box-sizing: border-box;
            font-family: var(--default-font);
            background-color: white  ;
        }

        .container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            height: 70px;
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
            margin: 0;
            padding: 0;
        }

        .header .nav ul li {

            border-radius: 5px;
            padding: 0;

            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .header .nav ul li:hover {
            background-color: #ffffff;
        }

        .header .nav ul li:hover a {
            color: var(--color-accent);
        }

        .header .nav ul li a {
            font-size: 20px;
            height: 50px;
            width: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            color: #ffffff;
            transition: color 0.3s ease;
        }

        .header-right {
            display: flex;
            align-items: center;
        }

        .search-form {
            display: flex;
            align-items: center;
            margin-right: 10px;
        }

        .search-form input {
            width: 200px;
            padding: 5px;
            border: none;
            border-radius: 3px 0 0 3px;
            outline: none;
            height: 40px;
        }

        .search-form button {
            font-size: 20px;
            padding: 5px 15px;
            border: 2px solid var(--color-accent);
            background-color: var(--color-accent);
            color: white;
            border-radius: 0 3px 3px 0;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .search-form button:hover {
            color: black;

        }

        .menu_list_button {
            font-size: 30px;
            cursor: pointer;
            color: white;
            margin-right: 20px;
            z-index: 10;
            /* Đảm bảo nút hiển thị trên các thành phần khác */
            position: relative;
            /* Đặt vị trí tương đối */
        }



        .menu_list_button:hover {
            color: black;
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
            top: 0;
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
            margin-top: 60px;
        }

        .menuleft-nav ul li a {
            display: flex;
            padding: 15px;
            text-decoration: none;
            color: #ffffff;
            background-color: var(--color-default);
            border-bottom: 1px solid #ccc;
        }

        .menuleft-nav ul li a:hover {
            background-color: var(--color-accent);
            border-radius: 5px;
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
            border: none;
            cursor: pointer;
        }

        .menuleft_button {
            margin-top: 50px;
        }

        .menuleft_button li button:hover {
            background-color: var(--color-success-text);
        }

        .tabbarright {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .tabbarright img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .footer {
            margin-top: auto;
            text-align: center;
            padding: 10px;
            background-color: #f1f1f1;
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #666;
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
                    <li><a href="index.php?mod=dichvu&act=list">Dịch vụ</a></li>
                    <li><a href="#statistic">Thống kê</a></li>
                </ul>
            </nav>
            <div class="header-right">
                <form class="search-form" role="search">
                    <input type="search" placeholder="Tìm kiếm..." aria-label="Search">
                    <button type="submit"><i class='bx bx-search'></i></button>
                </form>
                <label for="menu_list_check" class="menu_list_button"><i class='bx bx-menu'></i></label>
            </div>
        </div>

        <input type="checkbox" id="menu_list_check" class="menu_list_button_check">
        <label for="menu_list_check" class="overlay"></label>

        <div class="menu">
            <div class="menuleft">
                <label for="menu_list_check" class="exit_menu_list"><i class='bx bx-x'></i></label>
                <nav class="menuleft-nav">
                    <ul>
                        <li><a href="index.php?mod=lichhen&act=list" id="lichhen"><i class='bx bx-calendar'></i> Lịch hẹn</a></li>
                        <li><a href="index.php?mod=lichhen&act=add"><i class='bx bxs-heart'></i> Khám bệnh</a></li>
                        <li><a href="index.php?mod=thuoc&act=ketoa"><i class='bx bxs-capsule'></i></i> Kê Thuốc</a></li>
                        <li><a href="index.php?mod=nguoidung&act=list"><i class='bx bxs-group'></i> Quản lí người dùng</a></li>
                        <li><a href="index.php?mod=benhnhan&act=list"><i class='bx bxs-duplicate'></i> Quản lí bệnh nhân</a></li>
                        <li><a href="index.php?mod=nhanvien&act=list"><i class='bx bxs-group'></i> Quản lí nhân viên</a></li>
                        <li><a href="index.php?mod=thietbi"><i class='bx bxs-server'></i> Quản lí thiết bị</a></li>
                    </ul>
                    <div class="menuleft_button">
                        <ul>
                            <li style="margin-top: 250px;"><button><i class='bx bx-log-out'></i> Đăng xuất</button></li>
                            <li style="margin-top: 20px;"><button><i class='bx bx-revision'></i> Tải lại</button></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div id="tabbarright" class="tabbarright">
                <?php echo $content; ?>
            </div>
        </div>

        <div class="footer">
            <span>By quocbo - quanghuy - tanphat @ vku-23JIT | <?php echo date("d/m/Y"); ?></span>
        </div>
    </div>

    <script src="assets/js/admin.js"></script>
</body>

</html>