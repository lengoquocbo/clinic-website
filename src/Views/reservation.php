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
                        <label for="CCCD">Email:</label>
                        <input type="text" id="CCCD" name="CCCD" required>
                    </div>
                    <div>
                        <label for="phone">Số điện thoại:</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <label for="date">Ngày khám:</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div>
                        <label for="department">Khoa:</label>
                        <select id="department" name="department" required>
                            <option value="">Chọn khoa</option>
                            <option value="cardiology">Khoa Tim mạch</option>
                            <option value="neurology">Khoa Thần kinh</option>
                            <option value="orthopedics">Khoa Chấn thương chỉnh hình</option>
                        </select>
                    </div>
                    <div>
                        <label for="service">Dịch vụ:</label>
                        <select id="service" name="service" required>
                            <option value="">Chọn dịch vụ</option>
                            <option value="service1">Dịch vụ 1</option>
                            <option value="service1">Dịch vụ 2</option>
                            <option value="service1">Dịch vụ 3</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="message">Nội dung:</label>
                    <textarea id="message" name="message" rows="4" placeholder="Nhập nội dung yêu cầu hoặc câu hỏi của bạn"></textarea>
                </div>
                <button type="submit">Gửi Đặt Lịch</button>
            </form>
        </div>