<?php
include '../includes/config.php';

// Query to fetch products
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

// Initialize an array to hold products
$products = array();

// Check if there are products
if (mysqli_num_rows($result) > 0) {
    // Loop through products and add them to the array
    while ($row = mysqli_fetch_assoc($result)) {
        // Ensure the image path is correct
        $row['image'] = '../Product_Page/' . $row['image'];  // Add the correct path to image
        $products[] = $row;
    }
} else {
    $products = [];  // No products found
}

// Return products as JSON
echo json_encode($products);
?>
