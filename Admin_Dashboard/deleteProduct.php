<?php
include '../includes/config.php';

if (isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);

    // Prepare query to prevent SQL injection
    $query = "DELETE FROM products WHERE product_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $product_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Product deleted successfully!";
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
}
?>
