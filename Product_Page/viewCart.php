<?php

session_start();
include '../includes/config.php';

if (isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];
    
    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

  
  
header('location:../Product_Page/shoppingCart.php');
}





?>