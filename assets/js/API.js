
const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const axios = require('axios');
const redis = require('redis');
const client = redis.createClient();
const jwt = require('jsonwebtoken');
const secretkey = "0e#$gsj_ncs5-6at9+d1dplyf0evc%";

const app = express();
const PORT = 3001; // Đổi sang port khác vì PHP đang chạy ở 3000

// Middleware
app.use(cors({
    origin: 'http://localhost',
    // origin: 'http://192.168.1.8', // Hoặc chỉ định domain cụ thể
    credentials: true,
    methods: ['GET', 'POST'],
    allowedHeaders: ['Content-Type', 'Authorization']
}));

app.use(bodyParser.json());

// Cấu hình
const PHP_BASE_URL = 'http://localhost:80'; // URL của server PHP
// const PHP_BASE_URL = 'http://192.168.56.1:80'; 




// Routes
app.post('/api/login', async (req, res) => {
    try {
        const { phone, password } = req.body;   

        // Validate input
        if (!phone || !password) {
            return res.status(400).json({
                success: false,
                message: 'Thiếu thông tin đăng nhập'
            });
        }
        console.log(phone); 
        console.log(password);
        // Gọi đến PHP backend  
        const response = await axios.post(
            `${PHP_BASE_URL}/clinic-website/src/Controllers/loginController.php`,
            { phone, password },
            {
                withCredentials: true,
                headers: {
                    Cookie: req.headers.cookie || '', // Truyền cookie từ client tới PHP backend
                },
            }
        );

        console.log('PHP Response:', response.data);


        // Trả về kết quả từ PHP
        res.json(response.data);



    } catch (error) {
        console.error('Login error:', error);

        // Xử lý các loại lỗi khác nhau
        if (error.response) {
            // Lỗi từ PHP server

            console.log('Error status:', error.response.status);
            console.log('Error data:', error.response.data);
            console.log('Error headers:', error.response.headers);
            res.status(error.response.status).json({
                success: false,
                message: 'loi tu server php'
            });
        } else if (error.request) {
            // Không thể kết nối đến PHP server
            res.status(503).json({
                success: false,
                message: 'Không thể kết nối đến server'
            });
        } else {
            // Lỗi khác
            res.status(500).json({
                success: false,
                message: 'Lỗi server'
            });
        }
    }
});

app.post('/api/register', async (req, res) => {
    try {
        // Validate input
        const requiredFields = ['phone', 'name', 'mail', 'pass'];
        for (const field of requiredFields) {
            if (!req.body[field]) {
                return res.status(400).json({
                    success: false,
                    message: `Thiếu thông tin: ${field}`
                });
            }
        }

        // Gọi đến PHP backend
        const response = await axios.post(
            `${PHP_BASE_URL}/clinic-website/src/Controllers/RegisterController.php`,
            req.body,
            {
                withCredentials: true,
                headers: {
                    Cookie: req.headers.cookie || '', // Truyền cookie từ client tới PHP backend
                },
            }
        );

        // Trả về kết quả từ PHP
        res.json(response.data);

    } catch (error) {
        console.error('Registration error:', error);
        
        if (error.response) {
            res.status(error.response.status).json({
                success: false,
                message: error.response.data.message || 'Lỗi từ server PHP'
            });
        } else if (error.request) {
            res.status(503).json({
                success: false,
                message: 'Không thể kết nối đến server'
            });
        } else {
            res.status(500).json({
                success: false,
                message: 'Lỗi server'
            });
        }
    }
});

app.post('/api/reservation', async (req, res) => {
    try {

        const requiredFields = ['token', 'hovaten', 'CCCD', 'gender', 'ngaykham', 'dateofbirth', 'service', 'address', 'message'];

        for (const field of requiredFields) {
            if (!req.body[field]) {
                return res.status(400).json({
                    success: false,
                    message: `Thiếu thông tin: ${field}`
                });
            }
        }

        const { token, hovaten, CCCD, gender, ngaykham, dateofbirth, service, address, message} = req.body;

        
        const payload = jwt.decode(token);
        if (!payload) {
            return res.status(414).json({
                success: false,
                message: `khong the giai ma token`
            });
        }

        const currentTime = Math.floor(Date.now() / 1000);
        const expirationTime = payload.exp;

        // So sánh thời gian
        if (currentTime >= expirationTime) {
            console.log('Token đã hết hạn');
            return res.status(414).json({
                success: false,
                message: `token da het han`
            });
        }

        userID = payload.user_id;
        mail = payload.email;
        phone = payload.phone;

      
        const response = await axios.post(

            `${PHP_BASE_URL}/clinic-website/src/Controllers/ReservationController.php`,
            {phone, mail, userID, hovaten, CCCD, gender, ngaykham, dateofbirth, service, address, message},
 
            {
                withCredentials: true,
                headers: {
                    Cookie: req.headers.cookie || '', // Truyền cookie từ client tới PHP backend
                },
            }
        );

        
        res.json(response.data);

    } catch (error) {
        console.error('Registration error:', error);
        
        if (error.response) {
            res.status(error.response.status).json({
                success: false,
                message: error.response.data.message || 'Lỗi từ server PHP'
            });
        } else if (error.request) {
            res.status(503).json({
                success: false,
                message: 'Không thể kết nối đến server'
            });
        } else {
            res.status(500).json({
                success: false,
                message: 'Lỗi kiem tra token'
            });
        }
    }
});

app.post('/api/logout', async (req, res) =>{
    try{
        
        
            
        
    } catch(error) {
        
        if (error.response) {
            res.status(error.response.status).json({
                success: false,
                message: error.response.data.message || 'Lỗi từ server PHP',
                error: error
            });
        } else if (error.request) {
            res.status(503).json({
                success: false,
                message: 'Không thể kết nối đến server'
            });
        } else {
            res.status(500).json({
                success: false,
                message: 'Lỗi server'
            });
        }
    }
});



app.post('/api/mailchangepass', async (req, res) => {
    try{
        const { mail, inputtype } = req.body;   
        console.log('Request body:', req.body);
        // Validate input
        if (!mail || !inputtype) {
            return res.status(400).json({
                success: false,
                message: 'Thiếu thông tin'
            });
        }
        
        // Gọi đến PHP backend
        const response = await axios.post(
            `${PHP_BASE_URL}/clinic-website/src/Controllers/ChangePassController.php`,
            { mail, inputtype },
            {
                withCredentials: true,
                headers: {
                    Cookie: req.headers.cookie || '', // Truyền cookie từ client tới PHP backend
                },
            }
        );
        console.log('PHP Response:', response.data);

        // Trả về kết quả từ PHP
        res.json(response.data);
        
        
    } catch(error) {
        
        if (error.response) {
            res.status(error.response.status).json({
                success: false,
                message: error.response.data.message || 'Lỗi từ server PHP',
                error: error
            });
        } else if (error.request) {
            res.status(503).json({
                success: false,
                message: 'Không thể kết nối đến server'
            });
        } else {
            res.status(500).json({
                success: false,
                message: 'Lỗi server'
            });
        }
    }
});

app.post('/api/updatepass', async (req, res) =>{
    try{
        const { mail, password, inputtype } = req.body;   

        // Validate input
        if (!mail || !password || !inputtype) {
            return res.status(400).json({
                success: false,
                message: 'Thiếu thông tin cập nhật'
            });
        }

        // Gọi đến PHP backend
        const response = await axios.post(
            `${PHP_BASE_URL}/clinic-website/src/Controllers/ChangePassController.php`,
            { mail, password, inputtype },
            {
                withCredentials: true,
                headers: {
                    Cookie: req.headers.cookie || '', // Truyền cookie từ client tới PHP backend
                },
            }
        );

        // Trả về kết quả từ PHP
        res.json(response.data);
    } catch(error) {
        console.error('Registration error:', error);
        
        if (error.response) {
            res.status(error.response.status).json({
                success: false,
                message: error.response.data.message || 'Lỗi từ server PHP'
            });
        } else if (error.request) {
            res.status(503).json({
                success: false,
                message: 'Không thể kết nối đến server'
            });
        } else {
            res.status(500).json({
                success: false,
                message: 'Lỗi server'
            });
        }
    }
});

app.post('/api/checkcode', async (req, res) =>{
    try {
        const { mail, code, inputtype } = req.body;
        console.log('Request body:', req.body);
        // Validate input
        if (!mail || !code || !inputtype) {
            return res.status(400).json({
                success: false,
                message: 'Thiếu mã xác nhận'
            });
        }

        // Gọi đến PHP backend
        const response = await axios.post(
            `${PHP_BASE_URL}/clinic-website/src/Controllers/ChangePassController.php`,
            { mail, code , inputtype },
            {
                withCredentials: true,
                headers: {
                    Cookie: req.headers.cookie || '', // Truyền cookie từ client tới PHP backend
                },
            }
        );
        console.log('PHP Response:', response.data);
        // Trả về kết quả từ PHP
        res.json(response.data);
    } catch(error) {
        console.error('Registration error:', error);
        
        if (error.response) {
            res.status(error.response.status).json({
                success: false,
                message: error.response.data.message || 'Lỗi từ server PHP'
            });
        } else if (error.request) {
            res.status(503).json({
                success: false,
                message: 'Không thể kết nối đến server'
            });
        } else {
            res.status(500).json({
                success: false,
                message: 'Lỗi server'
            });
        }
    }
});



// Health check endpoint
app.get('/health', (req, res) => {
    res.status(200).json({ status: 'OK' });
});

// Global error handler
app.use((err, req, res, next) => {
    console.error('Unhandled error:', err);
    res.status(500).json({
        success: false,
        message: 'Đã xảy ra lỗi không mong muốn'
    });
});

// Start server
app.listen(PORT, () => {
    console.log(`Node.js server running on port ${PORT}`);
});

function checkTokenExpiration(token) {
    try {
        // Giải mã token (không cần secret key để kiểm tra hết hạn)
        const decoded = jwt.decode(token);

        if (!decoded) {
            console.log('Token không hợp lệ');
            return false;
        }

        // Lấy thời gian hết hạn
        const currentTime = Math.floor(Date.now() / 1000);
        const expirationTime = decoded.exp;

        // So sánh thời gian
        if (currentTime >= expirationTime) {
            console.log('Token đã hết hạn');
            return false;
        } else {
            const timeRemaining = expirationTime - currentTime;
            console.log(`Token còn hiệu lực: ${timeRemaining} giây`);
            return true;
        }
    } catch (error) {
        console.error('Lỗi kiểm tra token:', error);
        return false;
    }
}

