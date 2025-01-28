<?php
include '../../includes/config.php';

if (isset($_POST['id'])) {
    $productId = $_POST['id'];

    // Prepare SQL query to delete the product
    $query = "DELETE FROM products WHERE product_id = $productId";
    
    if (mysqli_query($conn, $query)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
