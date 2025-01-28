<?php
session_start();
include '../includes/config.php';


$logged_in_users_query = "SELECT COUNT(*) as total_users FROM users";
$logged_in_users_result = mysqli_query($conn, $logged_in_users_query);
$logged_in_users = mysqli_fetch_assoc($logged_in_users_result)['total_users'];


$total_products_query = "SELECT COUNT(*) as total_products FROM products";
$total_products_result = mysqli_query($conn, $total_products_query);
$total_products = mysqli_fetch_assoc($total_products_result)['total_products'];


$completed_orders_query = "SELECT COUNT(*) as total_orders FROM orders WHERE payment_status = 'completed'";
$completed_orders_result = mysqli_query($conn, $completed_orders_query);
$total_completed_orders = mysqli_fetch_assoc($completed_orders_result)['total_orders'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
       

        .dashboard-container {
            padding: 40px;
            text-align: center;
        }

        .dashboard-header {
            margin-bottom: 20px;
            font-size: 2.5em;
            color: #444;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px auto;
            max-width: 1000px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card h2 {
            font-size: 2em;
            margin-bottom: 10px;
            color: #28a745;
        }

        .card p {
            font-size: 1.2em;
            color: #666;
        }

        .btn-logout {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 25px;
            font-size: 1.2em;
            background-color: #d9534f;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1 class="dashboard-header">Admin Dashboard</h1>

        <div class="dashboard-grid">
            <div class="card">
                <h2><?php echo $logged_in_users; ?></h2>
                <p>Logged-in Users</p>
            </div>
            <div class="card">
                <h2><?php echo $total_products; ?></h2>
                <p>Total Products</p>
            </div>
            <div class="card">
                <h2><?php echo $total_completed_orders; ?></h2>
                <p>Completed Orders</p>
            </div>
        </div>

        <a href="../logout.php" class="btn-logout">Logout</a>
    </div>
</body>
</html>
