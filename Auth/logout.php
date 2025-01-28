<?php
// logout.php
session_start();
include '../includes/config.php'; // Include the database connection

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    $query = "UPDATE users SET isActive = 0 WHERE Id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);

   
    if ($stmt->execute()) {
        
    } else {
      
        echo "Error updating status.";
    }
    $stmt->close();

    
    session_unset(); 
    session_destroy();

    header('Location: login.php');
    exit();
} else {

    header('Location: login.php');
    exit();
}
?>
