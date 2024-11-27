<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phòng khám</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body>

    <!-- Phần Trang chủ -->
    <section id="home">
        <div class="home-slideshow">
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <img src="https://media-cdn-v2.laodong.vn/storage/newsportal/2023/8/26/1233821/Giai-Nhi-1--Nang-Tre.jpg" alt="Chăm sóc sức khỏe">
                    <div class="text">Chăm sóc sức khỏe toàn diện</div>
                </div>
                <div class="mySlides fade">
                    <img src="https://img.pikbest.com/origin/09/19/03/61zpIkbEsTGjk.jpg!w700wp" alt="Khám bệnh định kỳ">
                    <div class="text">Khám bệnh định kỳ</div>
                </div>
                <div class="mySlides fade">
                    <img src="https://d1hjkbq40fs2x4.cloudfront.net/2017-08-21/files/landscape-photography_1645.jpg" alt="Chăm sóc gia đình">
                    <div class="text">Chăm sóc gia đình</div>
                </div>
            </div>
            <a href="#services" class="cta-button">Khám phá các dịch vụ</a>
        </div>
        <div class="home-content">
            <h2>Chào mừng bạn đến với Phòng Khám Sức Khỏe</h2>
            <p>Chúng tôi tự hào cung cấp dịch vụ chăm sóc sức khỏe chất lượng cao với đội ngũ y bác sĩ hàng đầu và công nghệ tiên tiến. Tại <strong>Phòng Khám Sức Khỏe ABC</strong>, chúng tôi cam kết mang đến sự chăm sóc tận tâm và toàn diện cho bạn và gia đình từ khâu phòng ngừa, chẩn đoán đến điều trị bệnh.</p>
            <div class="services-list">
                <div class="service-item">
                    <i class="fa fa-calendar-check-o"></i>
                    <h3>Dịch vụ khám sức khỏe định kỳ</h3>
                    <p>Đảm bảo sức khỏe của bạn với các đợt kiểm tra định kỳ.</p>
                </div>
                <div class="service-item">
                    <i class="fa fa-stethoscope"></i>
                    <h3>Chẩn đoán và điều trị bệnh lý chuyên sâu</h3>
                    <p>Cung cấp chẩn đoán chính xác và điều trị các bệnh lý phức tạp.</p>
                </div>
                <div class="service-item">
                    <i class="fa fa-apple"></i>
                    <h3>Tư vấn dinh dưỡng và lối sống lành mạnh</h3>
                    <p>Hướng dẫn về chế độ ăn uống và lối sống để duy trì sức khỏe tối ưu.</p>
                </div>
            </div>
        </div>
        <div class="departments">
            <div class="container">
                <h1 class="heading">Các Khoa Chuyên Môn của Phòng Khám</h1>
                <div class="content">
                    <ul class="department-list">
                        <li data-department="1">Khoa Nội</li>
                        <li data-department="2">Khoa Nhi</li>
                        <li data-department="3">Khoa Sản</li>
                        <li data-department="4">Khoa Da Liễu</li>
                        <li data-department="5">Khoa Mắt</li>
                        <li data-department="6">Khoa Tai Mũi Họng</li>
                    </ul>
                    <div class="department-details">
                        <div id="department-info">
                            <img id="department-image" src="" alt="Khoa">
                            <div>
                                <h2 id="department-title">Chọn một khoa</h2>
                                <p id="department-description">Thông tin về khoa sẽ xuất hiện ở đây.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Phần Dịch vụ -->
    <section id="services">
        <div class="services-header">
            <h2>Dịch vụ chăm sóc sức khỏe của chúng tôi</h2>
        </div>
        <div class="services-container">
            <div class="service-item">
                <img src="https://media.vneconomy.vn/w800/images/upload/2022/09/05/rice-field-terrace-vietnam-shutterstock-554460046-d71ff868b1.jpeg" alt="Khám tổng quát">
                <h3>Khám Tổng Quát</h3>
                <p>Chúng tôi cung cấp dịch vụ khám tổng quát định kỳ để đảm bảo sức khỏe của bạn và gia đình.</p>
            </div>
            <div class="service-item">
                <img src="https://media.vneconomy.vn/w800/images/upload/2022/09/05/rice-field-terrace-vietnam-shutterstock-554460046-d71ff868b1.jpeg" alt="Điều trị chuyên sâu">
                <h3>Điều Trị Chuyên Sâu</h3>
                <p>Đội ngũ bác sĩ của chúng tôi sẵn sàng điều trị các bệnh lý chuyên sâu với công nghệ tiên tiến.</p>
            </div>
            <div class="service-item">
                <img src="https://media.vneconomy.vn/w800/images/upload/2022/09/05/rice-field-terrace-vietnam-shutterstock-554460046-d71ff868b1.jpeg" alt="Tư vấn dinh dưỡng">
                <h3>Tư Vấn Dinh Dưỡng</h3>
                <p>Chúng tôi cung cấp tư vấn dinh dưỡng và lập kế hoạch chế độ ăn uống phù hợp với nhu cầu của bạn.</p>
            </div>
        </div>
        <div class="cta-container">
            <a href="#contact" class="cta-button">Liên hệ với chúng tôi</a>
        </div>
    </section>
    <!-- Phần Đội ngũ nhân viên -->
    <section id="team">
        <h2>Đội ngũ nhân viên</h2>
        <p>Đội ngũ chuyên gia y tế hàng đầu với nhiều năm kinh nghiệm trong các lĩnh vực sức khỏe và y tế. Chúng tôi tự hào vì có một đội ngũ bác sĩ tận tâm, nhiệt tình và luôn cập nhật các kiến thức y khoa mới nhất.</p>
        <div class="team-members">
            <?php
            foreach ($data_nhanvien as $nhanvien) {
                if (isset($nhanvien) && !empty($nhanvien)) {

            ?>
                    <div class="team-member">
                        <img
                            src="<?php echo UPLOAD_DIR . $nhanvien['hinhanh']; ?>"
                            alt="<?php echo $nhanvien['fullname']; ?>">
                        <h3><?php echo $nhanvien['fullname']; ?></h3>
                        <p><?php echo $nhanvien['status']; ?></p>
                    </div>
            <?php
                } else {
                    // Hiển thị ảnh mặc định hoặc thông báo
                    echo "Không có thông tin nhân viên";
                }
            }
            ?>
        </div>
    </section>


    <!-- Phần Đặt lịch -->
    <?php
    if (isset($_SESSION['isLogin'])) {
    ?>
        <section id="appointment">
            <div class="appointment-header">
                <h2>Đặt Lịch Hẹn</h2>
                <p>Hãy điền thông tin vào form bên dưới để đặt lịch hẹn với chúng tôi. Chúng tôi sẽ liên hệ với bạn để xác nhận lịch hẹn.</p>
            </div>
            <div class="appointment-form">
                <form action="#" method="post">
                    <div class="row">
                        <div>
                            <label for="name">Họ và tên:</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div>
                            <label for="CCCD">CCCD:</label>
                            <input type="text" id="CCCD" required>
                        </div>
                        <div>
                            <label for="gender">Giới tính:</label>
                            <select name="gender" id="gender" required>
                                <option value="">Chọn giới tính</option>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            <label for="ngaykham">Ngày khám:</label>
                            <div style="position: relative; display: inline-block;">
                                <input type="text" id="ngaykham" name="ngaykham" placeholder="Chọn ngày giờ" style="padding-right: 30px;">
                                <i class="fas fa-calendar-alt calendar-icon"
                                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                            </div>

                        </div>
                        <div>
                            <label for="dateofbirth">Ngày sinh:</label>
                            <input type="date" id="dateofbirth" name="dateofbirth" required>
                        </div>
                        <div>
                            <label for="service">Dịch vụ:</label>
                            <select id="service" name="service" required>
                                <option value="">Chọn dịch vụ</option>
                                <?php foreach ($data_dichvu as $dichvu): ?>
                                    <option value="<?php echo $dichvu['serviceID']; ?>">
                                        <?php echo $dichvu['servicename']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            <label for="address">Địa chỉ:</label>
                            <input type="text" id="address" name="address" required>
                        </div>
                    </div>
                    <div>
                        <label for="message">Nội dung:</label>
                        <textarea id="message" name="message" rows="4" placeholder="Nhập nội dung yêu cầu hoặc câu hỏi của bạn"></textarea>
                    </div>
                    <button id="datlich">Gửi Đặt Lịch</button>
                </form>
            </div>
        </section>
    <?php
    }
    ?>


    <!-- giao dien kiem tra lich su -->

    <section id="contact">
        <h2>Liên hệ với chúng tôi</h2>
        <p>Chúng tôi luôn sẵn sàng hỗ trợ bạn với bất kỳ câu hỏi hoặc yêu cầu nào. Vui lòng tham khảo thông tin liên hệ bên dưới hoặc xem bản đồ để tìm đến chúng tôi.</p>
        <div class="contact-container">
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Địa chỉ</h3>
                    <p>123 Đường ABC, Thành phố XYZ, Việt Nam</p>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <h3>Điện thoại</h3>
                    <p>(+84) 123 456 789</p>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <h3>Email</h3>
                    <p>info@example.com</p>
                </div>
            </div>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5583.47329390081!2d108.2551786738347!3d15.97616031594819!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIFZp4buHdCAtIEjDoG4sIMSQ4bqhaSBo4buNYyDEkMOgIE7hurVuZw!5e0!3m2!1svi!2s!4v1726305492048!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>



    <!-- Phần Hồ sơ bệnh án -->
    <section id="medical_record">
        <h2>Hồ sơ bệnh án</h2>
        <form action="" method="POST">
            <label for="name">Họ và tên:</label><br>
            <input type="text" id="name" name="name" required><br><br>

            <label for="medical_history">Hồ sơ bệnh án:</label><br>
            <textarea id="medical_history" name="medical_history" rows="5" required></textarea><br><br>

            <button type="submit">Thêm hồ sơ</button>
        </form>
    </section>

    <!-- Nút lên đầu trang -->
    <button id="backToTop" onclick="scrollToTop()">Lên đầu trang</button>

    <!-- JavaScript cho nút cuộn về đầu trang -->
    <script>
        window.onscroll = function() {
            if (document.documentElement.scrollTop > 100) {
                document.getElementById("backToTop").style.display = "block";
            } else {
                document.getElementById("backToTop").style.display = "none";
            }
        };


        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>

    <script>
        // Khởi tạo Flatpickr
        const flatpickrInstance = flatpickr("#ngaykham", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            allowInput: true
        });

        // Thêm sự kiện click cho biểu tượng lịch
        const calendarIcon = document.querySelector('.calendar-icon');
        if (calendarIcon) {
            calendarIcon.addEventListener('click', () => {
                flatpickrInstance.open(); // Mở Flatpickr khi nhấp vào biểu tượng
            });
        }
    </script>

    <script src="assets/js/UI.js"></script>
</body>

</html>