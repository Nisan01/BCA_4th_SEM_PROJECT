<?php

session_start();
include '../includes/config.php';

if(isset(  $_SESSION['admin_user_id'])){
    $admin_user_id = $_SESSION['admin_user_id'];
}

else{
header('location: /php/Creators_Mela/Auth/login.php');
exit;
}


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
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navigation Bar -->

<nav class="navbar">
    <ul class="navbar-list">
        <li><a href="#" class="<?= $activeClassManageProducts ?>" onclick="loadPage('manage-products')">Manage Products</a></li>
       
        <li><a href="#" class="<?= $activeClassCustomers ?>" onclick="loadPage('customerinfo/customerinfo')">Customers/Users</a></li>
        <li><a href="#" class="<?= $activeClassMessages ?>" onclick="loadPage('messages/messages')">Messages</a></li>
        <li><a href="#" class="<?= $activeClassFeedback ?>" onclick="loadPage('feedbackResponse/feedback')">Feedback</a></li>
    </ul>

    <a href="Admin_Logout/adminLogout.php"><button id="adminLogoutbtn">Logout</button></a>
</nav>

<!-- Content Container -->
<div id="content">

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


    </div>


</div>

<!-- JavaScript Code -->
<script src="../jquery/jquery.js"></script>

<script>

$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    var section = urlParams.get('section');

    if (section) {
        loadPage(section); 
    }
});


function loadPage(page) {
    // Update the URL with the 'section' parameter for the active state
    history.pushState({ section: page }, "", `?section=${page}`);
    
  
    $.ajax({
        url: `${page}.php`, 
        method: "GET",
        success: function(data) {
            $("#content").html(data);
            updateActiveLink(page); // Call function to set active class
        },
        error: function(xhr, status, error) {
            console.error("Error loading page:", error);
        }
    });
}


function updateActiveLink(page) {
    // Remove 'active' class from all links
    $('nav ul li a').removeClass('active');
    
    // Add 'active' class to the clicked link
    $('a[onclick="loadPage(\'' + page + '\')"]').addClass('active');
}
</script>

</body>
</html>
