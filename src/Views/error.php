<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <style>
        
        .error {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .error-container {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            width: 100%;
        }

        .error-container h1 {
            font-size: 72px;
            color: #e74c3c;
        }

        .error-container p {
            font-size: 16px;
            margin: 10px 0 20px;
            color: #555;
        }

        .error-container a {
            display: inline-block;
            text-decoration: none;
            color: #fff;
            background-color: #3498db;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .error-container a:hover {
            background-color: #2980b9;
        }

        .error-container a:active {
            transform: scale(0.95);
        }
    </style>
</head>
<body>
    <div class="error">
        <div class="error-container">
            <h1>404</h1>
            <p>Oops! The page you are looking for does not exist.</p>
            <a href="/">Go Back Home</a>
        </div>
    </div>
</body>
</html>
