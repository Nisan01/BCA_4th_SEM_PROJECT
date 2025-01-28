<?php
session_start();
include '../includes/config.php';  // Database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Get the field and new value from the request
$field = isset($_POST['field']) ? $_POST['field'] : '';
$value = isset($_POST['value']) ? $_POST['value'] : '';

// Validate the field and prepare the update query
if ($field && $value) {
    if ($field == 'name') {
        // Assuming name consists of both Firstname and Lastname, split them
        $names = explode(' ', $value);
        $firstname = $names[0];
        $lastname = isset($names[1]) ? $names[1] : '';

        $query = "UPDATE `users` SET `Firstname` = '$firstname', `Lastname` = '$lastname' WHERE `Id` = '$user_id'";
    } elseif ($field == 'email') {
        $query = "UPDATE `users` SET `Email` = '$value' WHERE `Id` = '$user_id'";
    } elseif ($field == 'experience') {
        $query = "UPDATE `users` SET `Experience` = '$value' WHERE `Id` = '$user_id'";
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid field']);
        exit();
    }

    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update profile']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
}
?>
