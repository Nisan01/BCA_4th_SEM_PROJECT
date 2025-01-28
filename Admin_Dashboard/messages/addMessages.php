<?php
session_start();
include '../../includes/config.php';

if (isset($_GET['msg'])) {
    $msg = mysqli_real_escape_string($conn, $_GET['msg']);
    $userid = $_SESSION["admin_user_id"];
   
    // Insert message into the database
    $q = "INSERT INTO `messages` (`Id`, `Message`) VALUES ('$userid', '$msg')";
    if (mysqli_query($conn, $q)) {
        echo "Message sent successfully!";
    } else {
        echo "Error sending message: " . mysqli_error($conn);
    }
} else {
    echo "No message provided!";
}
?>