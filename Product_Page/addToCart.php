<?php

session_start();
include '../includes/config.php';

if (isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];
    
   
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

   
    if (!in_array($p_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $p_id;  // Add product to cart if it's not already there



    
}
header('location:index.php');
}





?>