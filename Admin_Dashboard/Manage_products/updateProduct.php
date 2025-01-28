<?php
include '../../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = isset($_POST['category']) ? $_POST['category'] : null;

    
    $query = "UPDATE products 
              SET product_name = '$productName', description = '$description', price = '$price', category = '$category' 
              WHERE product_id = $productId";

   
    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $image = $_FILES['image']['name'];
        $targetDir = "../../Product_Page/images";
        $targetFile = $targetDir . "/" . basename($image);

   
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $relativeImagePath = "images/" . basename($image);
                // Add the image to the UPDATE query
                $query = "UPDATE products 
                          SET product_name = '$productName', description = '$description', price = '$price', category = '$category', image = '$relativeImagePath' 
                          WHERE product_id = $productId";
            } else {
                echo "Failed to upload image.";
                exit();
            }
        } else {
            echo "Upload error: " . $_FILES['image']['error'];
            exit();
        }
    }

    // Execute the update query
    if (mysqli_query($conn, $query)) {
        echo "success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
