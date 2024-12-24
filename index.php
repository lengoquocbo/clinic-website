<html>
    <script> const port = "192.168.35.106"; </script>
</html>
<?php
    
    session_start();
    // session_destroy();

    require_once 'vendor/autoload.php';
    
    require_once 'config.php';
    define('SECURE_ACCESS', true);  
    
    use Dotenv\Dotenv;

    // Tạo đối tượng Dotenv và nạp các biến từ tệp .env
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $mod = isset($_GET['mod']) ? $_GET['mod'] : 'Home';

    switch($mod) {
        case 'Home':
            require_once __DIR__.'/src/Controllers/HomeController.php';
            $Home_ob = new Home();
            $Home_ob->list();
            
            break;  
        case 'taikhoan':
            $act = isset($_GET['act']) ? $_GET['act'] : 'login';
            
            if((isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true)){
                switch($act) {
                    case 'profile':
                        require_once __DIR__.'/src/Controllers/AccountController.php';
                        $Account = new Account();
                        $Account->profile();
                        break;
                    case 'history':
                        require_once __DIR__."/src/Controllers/HoSoBenhAnController.php";
                        $Hoso = new Hoso();
                        $Hoso->Hoso();
                        break;
                    case 'detail':
                        $id = isset($_GET['id']) ? $_GET['id'] : '1';
                        require_once __DIR__."/src/Controllers/HoSoBenhAnController.php";
                        $Hoso = new Hoso();
                        $Hoso->detail($id);
                        break;
                    case 'appointment':
                        require_once __DIR__.'/src/Controllers/myappoinmentcontroller.php';
                        $lichhen = new lichhen();
                        $lichhen->getlichhen();
                        break;
                    default: 
                        header('Location: ?mod=error');
                        break;
                }
            } else if((isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) || (isset($_SESSION['isLogin_Nhanvien']) && $_SESSION['isLogin_Nhanvien'] == true)){

            } else {
                
                switch ($act) {
                    case 'login':
                        require_once __DIR__.'/src/Views/index.php';
                        break;
                    case 'register':
                        require_once __DIR__.'/src/Views/index.php';
                        break;
                    case 'forget':
                        require_once __DIR__.'/src/Views/changepass.php';
                        break;
                    default:
                        require_once __DIR__.'/src/Views/index.php';
                        break;
                }
            }
            break;
        default:
            require_once __DIR__.'/src/Controllers/HomeController.php';
            $Home_ob = new Home();
            $Home_ob->list();
            break;
    }
?>

