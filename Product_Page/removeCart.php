<?php

session_start();
include '../includes/config.php';

if (isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];
    if (isset($_SESSION['cart'])) {
        $key = array_search($p_id, $_SESSION['cart']);
        if ($key !== false) {
            unset($_SESSION['cart'][$key]);
        }
    }



header('location:shoppingCart.php');



}


    ?>