<?php
// You can add any custom failure messages or log errors if needed
$failure_message = "Your payment was not successful. Please try again.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failure</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: #e74c3c;
            font-size: 32px;
        }
        p {
            font-size: 16px;
            color: #333;
        }
        .message {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            margin-top: 20px;
            background-color: #e74c3c;
            color: white;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Failed</h1>
        <div class="message">
            <p><?php echo $failure_message; ?></p>
        </div>
        <p>If you think this is an error, please contact our support team or try again later.</p>
        <a href="../../Homepage/Homepage.php" class="button">Go Back to Homepage</a>
    </div>
</body>
</html>
