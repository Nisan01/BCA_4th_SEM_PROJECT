<?php

session_start();
include '../includes/config.php';

$response = ['success' => false, 'error' => 'Unknown error occurred.'];

if (!isset($_SESSION['user_id'])) {
    $response['error'] = 'User not logged in.';
    echo json_encode($response);
    exit;
}

// Check if a file is uploaded
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
 
    $user_id = $_SESSION['user_id'];

    // Directory to store the uploaded image
    $upload_dir = '../Images/';
    $image_name = basename($_FILES['profile_image']['name']);
    $upload_file = $upload_dir . $image_name;

    // Move the uploaded file
    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_file)) {
     
        $query = "UPDATE `users` SET `Image` = '$image_name' WHERE `Id` = '$user_id'";
        if (mysqli_query($conn, $query)) {
            $response['success'] = true;
            $response['image_path'] = $upload_file;
        } else {
            $response['error'] = 'Database update failed: ' . mysqli_error($conn);
        }
    } else {
        $response['error'] = 'File upload failed.';
    }
} else {
    $response['error'] = 'No file uploaded or upload error: ' . $_FILES['profile_image']['error'];
}


echo json_encode($response);
?>
