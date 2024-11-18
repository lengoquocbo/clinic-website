
const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const axios = require('axios');
const redis = require('redis');
const client = redis.createClient();

const app = express();
const PORT = 3001; // Đổi sang port khác vì PHP đang chạy ở 3000

// Middleware
app.use(cors({
    origin: '*', // Hoặc chỉ định domain cụ thể
    methods: ['GET', 'POST'],
    allowedHeaders: ['Content-Type', 'Authorization']
}));

app.use(bodyParser.json());

// Cấu hình
const PHP_BASE_URL = 'http://localhost:80'; // URL của server PHP
// const PHP_BASE_URL = 'http://192.168.35.234'; 




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

        // Gọi đến PHP backend
        const response = await axios.post(
            `${PHP_BASE_URL}/clinic-website/src/Controllers/LoginController.php`,
            { phone, password }
        );

        // Trả về kết quả từ PHP
        res.json(response.data);

    } catch (error) {
        console.error('Login error:', error);

        // Xử lý các loại lỗi khác nhau
        if (error.response) {
            // Lỗi từ PHP server
            res.status(error.response.status).json({
                success: false,
                message: error.response.data.message || 'Lỗi từ server PHP'
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
            req.body
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
            { mail, inputtype }
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
            { mail, password, inputtype }
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
            { mail, code , inputtype }
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


