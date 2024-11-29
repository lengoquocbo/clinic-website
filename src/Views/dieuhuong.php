<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$mod = isset($_GET['mod']) ? $_GET['mod'] : "home";
switch($mod) {
    case 'home':
        require_once('home.php');
        break;
    case 'taikhoan':
        $act = isset($_GET['act']) ? $_GET['act'] : "login";
        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
            switch($act) {
                case 'profile':
                    require_once("account.php");
                    break;
                case 'history':
                    require_once 'history.php';
                    break;
                case 'detail':
                    require_once 'detailHistory.php';
                    break;
                default:
                    require_once("login.php");
                    break;
            }
        } else if((isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) || (isset($_SESSION['isLogin_Nhanvien']) && $_SESSION['isLogin_Nhanvien'] == true)){

        } else {
            switch ($act) {
                case 'login':
                    require_once("login.php");
                    break;
                case 'register':
                    require_once('register.php');
                    break;
                default:
                    require_once("login.php");
                    break;
            }
        }
        break;
    default: 
        require_once('error.php');
        break;
}
?>