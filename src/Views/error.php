<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <style>
        .error-main {
            display: flex;
            flex-direction: column;
            height: 100%;
            text-align: center;
            justify-content: center;
            align-items: center;
            margin-top: 200px;
            transform: scale(1.7);
            color: #333; /* Adjusted color */
        }
        .error-title {
            font-size: 3rem; /* Adjusted font size */
            margin: 0;
            color: #FF6347; /* Adjusted color */
            transform: scale(1.5);
            margin-bottom: 20px;
        }
        .error-description {
            font-size: 1.2rem; /* Adjusted font size */
            font-weight: bold;
            color: #FF6347; /* Adjusted color */
            margin-bottom: 10px;
        }
        .error-message {
            font-size: 1rem; /* Adjusted font size */
            margin-bottom: 30px;
            color: #333; /* Adjusted color */
        }
        .backToHome {
            background-color: #FF6347; /* Adjusted background color */
            padding: 10px;
            border-radius: 20px;
            color: white; /* Adjusted text color */
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="error-page" class="error-main">
        <h2 class="error-title">Oops!</h2>
        <p class="error-description">Sorry, an unexpected error has occurred.</p>
        <p class="error-message">
            <i>Error details will appear here</i>
        </p>
        <button onClick="history.back()">
            <span class="backToHome">Back to previous page</span>
        </button>
    </div>
</body>
</html>
