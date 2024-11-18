<header>
        <nav>
            <div class="menu-toggle">
                <span class="home-link" ><a href="#home">Trang chủ</a></span>
                <i class='bx bx-menu-alt-right'></i>
            </div>
            <ul id="nav-menu">
                <li><a href="#home">Trang chủ</a></li>
                <li><a href="#services">Dịch vụ</a></li>
                <li><a href="#team">Đội ngũ nhân viên</a></li>
                <li><a href="#appointment">Đặt lịch</a></li>
                <li><a href="#contact">Liên hệ</a></li>
                <?php
                    if (!isset($_SESSION['user_id'])) {
                        echo '<li><a href="?mod=login" class="link">Đăng nhập</a></li>';
                        echo '<li><a href="register.php" class="link">Đăng ký</a></li>';
                    } else {
                        echo 
                        '<li class="dropdown">
                                <a href="#" class="dropdown-toggle">
                                    Tài khoản của tôi
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="profile.php">Quản lý hồ sơ</a></li>
                                    <li><a href="medical-history.php">Lịch sử khám bệnh</a></li>
                                    <li><a href="appointments.php">Lịch hẹn của tôi</a></li>
                                    <li><a href="logout.php" class="link">Đăng xuất</a></li>
                                </ul>
                         </li>';
                    }
                ?>
            </ul>
        </nav>
    </header>