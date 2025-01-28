<?php

include '../../includes/config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form data
    $productName = $_POST['productName'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    
    $image = $_FILES['image']['name'];
    $targetDir = "../../Product_Page/images";
    $targetFile = $targetDir . "/" . basename($image);


    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        echo "Upload error: " . $_FILES['image']['error'];
        exit();
    }

 
    if (!is_dir($targetDir)) {
        echo "Error: Target directory does not exist.";
        exit();
    } elseif (!is_writable($targetDir)) {
        echo "Error: Target directory is not writable.";
        exit();
    }

  
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
    
        $relativeImagePath = "images/" . basename($image);

     
        $query = "INSERT INTO products (product_name, description, price, category, image) 
                  VALUES ('$productName', '$description', '$price', '$category', '$relativeImagePath')";

        if (mysqli_query($conn, $query)) {
            // Return success message
            echo "success";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to upload image.";
    }
}
?>
