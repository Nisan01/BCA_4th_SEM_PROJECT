<?php
session_start();

if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']); 
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .success-container {
            background-color: #fff;
            padding: 40px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h1 {
            color: #28a745;
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 30px;
        }

        .btn-home {
            display: inline-block;
            padding: 12px 25px;
            font-size: 1.2em;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-home:hover {
            background-color: #218838;
        }

        .icon-check {
            font-size: 60px;
            color: #28a745;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="icon-check">✔️</div>
        <h1>Payment Successful</h1>
        <p>Your payment was successfully processed. Thank you for your purchase!</p>
        <a href="../../Homepage/Homepage.php" class="btn-home">Back to Home</a>
    </div>
</body>
</html>

