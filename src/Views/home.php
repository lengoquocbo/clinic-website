

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phòng Khám Sức Khỏe</title>
    <link rel="stylesheet" href="../../assets/css/UI.css">
    <link rel="stylesheet" href="../../assets/css/responsiveUI.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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
    <!-- Phần Đặt lịch -->
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
                        <input type="text" id="CCCD" name="CCCD" required>
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
                        <label for="date">Ngày khám:</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div>
                        <label for="dateofbirth">Ngày sinh:</label>
                        <input type="date" id="dateofbirth" name="dateofbirth" required>
                    </div>
                    <div>
                        <label for="service">Dịch vụ:</label>
                        <select id="ID" name="ID" required>
                            <option value="">Chọn dịch vụ</option>
                            <option value="Dịch vụ A">Dịch vụ A</option>
                            <option value="Dịch vụ B">Dịch vụ B</option>
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
                <button type="submit" id="submit">Gửi Đặt Lịch</button>
            </form>

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

    <!-- Phần Đội ngũ nhân viên -->
    <section id="team">
        <h2>Đội ngũ nhân viên</h2>
        <p>Đội ngũ chuyên gia y tế hàng đầu với nhiều năm kinh nghiệm trong các lĩnh vực sức khỏe và y tế. Chúng tôi tự hào vì có một đội ngũ bác sĩ tận tâm, nhiệt tình và luôn cập nhật các kiến thức y khoa mới nhất.</p>
        <div class="team-members">
            <div class="team-member">
                <img src="https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Bác sĩ Nguyễn Văn A">
                <h3>Bác sĩ Nguyễn Văn A</h3>
                <p>Chuyên khoa Tim mạch. Với hơn 15 năm kinh nghiệm trong lĩnh vực tim mạch, bác sĩ A nổi bật với sự am hiểu sâu rộng và khả năng chẩn đoán chính xác các bệnh lý về tim.</p>
            </div>
            <div class="team-member">
                <img src="https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Bác sĩ Trần Thị B">
                <h3>Bác sĩ Trần Thị B</h3>
                <p>Chuyên khoa Thần kinh. Bác sĩ B là một chuyên gia hàng đầu trong điều trị các rối loạn thần kinh, với nhiều năm kinh nghiệm và kỹ năng điều trị các bệnh lý phức tạp.</p>
            </div>
            <div class="team-member">
                <img src="https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Bác sĩ Lê Văn C">
                <h3>Bác sĩ Lê Văn C</h3>
                <p>Chuyên khoa Chấn thương chỉnh hình. Bác sĩ C nổi bật với kỹ năng phẫu thuật tinh tế và kinh nghiệm điều trị các chấn thương xương khớp, giúp bệnh nhân phục hồi nhanh chóng và hiệu quả.</p>
            </div>
            <div class="team-member">
                <img src="https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Y tá Nguyễn Thị D">
                <h3>Y tá Nguyễn Thị D</h3>
                <p>Được đào tạo chuyên sâu và có nhiều năm kinh nghiệm trong chăm sóc bệnh nhân, Y tá D luôn sẵn sàng hỗ trợ và đồng hành cùng bệnh nhân trong suốt quá trình điều trị.</p>
            </div>
            <div class="team-member">
                <img src="https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Kỹ thuật viên xét nghiệm Mai Văn E">
                <h3>Kỹ thuật viên xét nghiệm Mai Văn E</h3>
                <p>Chịu trách nhiệm thực hiện các xét nghiệm chính xác và kịp thời, Kỹ thuật viên E đóng vai trò quan trọng trong việc cung cấp thông tin chính xác cho các bác sĩ.</p>
            </div>
        </div>
    </section>
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
    <footer>
        <div class="container-footer">
            <div class="footer">
                <!-- Phần Đăng ký nhận tin tức -->
                <div class="newsletter">
                    <div class="newsletter-left">
                        <h2>ĐẶT LỊCH KHÁM NGAY</h2>
                    </div>
                    <div class="newsletter-right">
                        <div class="newsletters-input">
                            <input type="email" placeholder="Nhập địa chỉ email của bạn" name="email" id="newsletter-email" required>
                            <button type="submit">Gửi</button>
                        </div>
                    </div>
                </div>

               

</body>

</html>
<script src="../../assets/js/UI.js"></script>
<script>
    d
</script>