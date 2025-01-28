<?php
// logout.php
session_start();
include '../includes/config.php'; // Include the database connection

if (isset($_SESSION['admin_user_id'])) {

  



    
    session_unset(); 
    session_destroy();

    header('Location: /php/Creators_Mela/Auth/login.php ');
    exit();
} else {

    header('location: /php/Creators_Mela/Auth/login.php');
    exit();
}
?>