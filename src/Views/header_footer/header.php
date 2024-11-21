
<header>
        <nav>
            <div class="menu-toggle">
                <span class="home-link" ><a href="#home">Trang chủ</a></span>
                <i class='bx bx-menu-alt-right'></i>
            </div>
            <ul id="nav-menu">
                <li><a href="?mod=home#home">Trang chủ</a></li>
                <li><a href="?mod=home#services">Dịch vụ</a></li>
                <li><a href="?mod=home#team">Đội ngũ nhân viên</a></li>
                <li><a href="#" onclick="checkSession(); return false;">Đặt lịch</a></li>
                <li><a href="?mod=home#contact">Liên hệ</a></li>
                <?php
                    if (!isset($_SESSION['isLogin'])) {
                        ?>
                        <li><a href="?mod=taikhoan&act=login" class="link">Đăng nhập</a></li>
                        <li><a href="?mod=taikhoan&act=register" class="link">Đăng ký</a></li>
                    <?php
                    } else {
                        ?>
                        <li class="dropdown">
                                <a href="#" class="dropdown-toggle">
                                    Tài khoản của tôi
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="profile.php">Quản lý hồ sơ</a></li>
                                    <li><a href="medical-history.php">Lịch sử khám bệnh</a></li>
                                    <li><a href="appointments.php">Lịch hẹn của tôi</a></li>
                                    <li><a href="#" class="link" id="logout" id="logout">Đăng xuất</a></li>
                                </ul>
                         </li>
                         <?php
                    }?>
            </ul>
        </nav>
    </header>