<?php
include '../../includes/config.php';


if (isset($_GET['id'])) {
    $productId = $_GET['id'];

  
    $query = "SELECT * FROM products WHERE product_id = $productId";
    $result = mysqli_query($conn, $query);

    // Check if the product exists
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found!";
        exit();
    }
} else {
    echo "Product ID is missing!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="Manage_products/style1.css">
    <script src="../jquery/jquery.js"></script><!-- Include jQuery -->
</head>
<body>
    <div class="form-wrapper">
        <form id="editProductForm" action="Manage_products/updateProduct.php" method="POST" enctype="multipart/form-data">
            <h2>Edit Product</h2>
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $product['description']; ?></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" required>
            <label for="category">Category:</label>
<select id="category" name="category" required  style="height:2rem">
    <option value="">Select Category</option>
    <!-- List of categories -->
    <option value="all" <?php if ($product['category'] == 'all') echo 'selected'; ?>>All</option>
    <option value="premierePro" <?php if ($product['category'] == 'premierePro') echo 'selected'; ?>>Premiere Pro</option>
    <option value="afterEffects" <?php if ($product['category'] == 'afterEffects') echo 'selected'; ?>>After Effects</option>
    <option value="davinciResolve" <?php if ($product['category'] == 'davinciResolve') echo 'selected'; ?>>Davinci Resolve</option>
    <option value="finalCutPro" <?php if ($product['category'] == 'finalCutPro') echo 'selected'; ?>>Final Cut Pro</option>
    <option value="photoshop" <?php if ($product['category'] == 'photoshop') echo 'selected'; ?>>Photoshop</option>
    <option value="motionGraphics" <?php if ($product['category'] == 'motionGraphics') echo 'selected'; ?>>Motion Graphics</option>
    <option value="overlays" <?php if ($product['category'] == 'overlays') echo 'selected'; ?>>Overlays</option>
    <option value="freebies" <?php if ($product['category'] == 'freebies') echo 'selected'; ?>>Freebies</option>
</select>

            <label for="image">Image:</label>
            <input type="file" id="image" name="image">
           
            <button type="submit">Update Product</button>
        </form>
        <div id="message"></div> <!-- Display success/error message here -->
    </div>

    <script>
        $(document).ready(function(){
            $("#editProductForm").on("submit", function(e){
                e.preventDefault(); // Prevent the default form submission
                
                var formData = new FormData(this); // Get form data including file
                
                $.ajax({
                    url: $(this).attr("action"),
                    type: "POST",
                    data: formData,
                    contentType: false, // Required when using FormData for file upload
                    processData: false, // Required when using FormData
                    success: function(response){
                        // Display success or error message
                        $("#message").html(response)
                     
                                .fadeIn(500)  // Fade in (500ms)
                                .delay(100)   // Wait for 1500ms (1.5s)
                                .fadeOut(3000);
                                setTimeout(function(){
                        window.location.href = "dashboard.php?section=manage-products"; // Redirect to the dashboard with manage-products section
                    }, 1500);


                    },
                    error: function(){
                        $("#message").html("An error occurred while updating the product.");
                    }
                });
            });
        });
    </script>
</body>
</html>
