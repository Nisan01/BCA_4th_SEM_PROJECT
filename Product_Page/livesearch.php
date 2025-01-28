<?php
include '../includes/config.php';

if (isset($_POST['input']) && isset($_POST['category'])) {
    $input = mysqli_real_escape_string($conn, $_POST['input']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

  
    $q = "SELECT * FROM products";

  
    $conditions = [];
    if ($input !== "") {
        $conditions[] = "(product_name LIKE '%$input%' OR price LIKE '%$input%')";
    }
    if ($category !== "all") {
        $conditions[] = "category = '$category'";
    }







    // Add conditions to the query
    if (!empty($conditions)) {
        $q .= " WHERE " . implode(" AND ", $conditions);
    }


    if ($category == "all") {
        $q .= " ORDER BY RAND()";
    }


    // $q .= " LIMIT 28";

    $result = mysqli_query($conn, $q);

    if (!$result) {
        die('Query Failed: ' . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='products-wrapper'>";

        while ($row = mysqli_fetch_assoc($result)) {
            $p_id = $row['product_id'];
            $p_name = $row['product_name'];
            $price = $row['price'];
            $image = $row['image'];




            echo "

            
            <div class='card-wrapper'>
                <div class='image-cart-container'>
                    <!-- Add to Cart button -->
                    <a href='addToCart.php?p_id=$p_id'>
                    
                            <i class='fa-solid fa-cart-shopping'></i>
                       
                    </a>
                </div>
                <a href='../Product_Page/productInfo.php?p_id=$p_id'>
                    <div class='front-part'>
                        <div class='image-container'>
                            <img src='$image' alt='$p_name'>
                        </div>
                    </div>
                    <div class='bottom-part'>
                        <div class='price-wrapper'>
                            <h4>Rs $price</h4>
                        </div>
                        <div class='buy'>
                            <h1>$p_name</h1>
                        </div>
                    </div>
                </a>
            </div>";
        }

        echo "</div>";
    } else {
        echo "<h6 class='text-danger text-center mt-3'>No data found</h6>";
    }
}
?>
