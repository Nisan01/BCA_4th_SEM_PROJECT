<?php
session_start();
include '../includes/config.php';



    if (isset($_GET['p_id'])) {

        $p_id = $_GET['p_id'];
      

        // Make sure to fetch product data
        $query = "SELECT * FROM products WHERE product_id='$p_id' ";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Fetch the product details here
            while ($row = mysqli_fetch_assoc($result)) {
                $product_name1 = $row['product_name'];
                $product_price1 = $row['price'];
                $product_desc1 = $row['description'];
                $product_image1 = $row['image'];
                $product_cate1 = $row['category'];
            }
        } else {
            echo "No product found with the ID: $p_id";
        }
    }




?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - Creators Mela</title>
    <style>
        * {

            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }

        .productInfoContainer {

            display: flex;
            width: 100%;
            height: 34rem;
          
            padding: 10px;
           
            justify-content: center;
           
            gap: 20px;
          
            background-color: #f9f9f9;
           
        }

        .product-page {
            display: flex;
            flex-direction: column;

            background-color: #929c8f;
        }

        .product-details {
            display: flex;
            gap: 20px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .image-gallery {

            display: flex;
        
            gap: 10px;


            position: relative;
            /* max-width: 26rem; */
            align-items: center;
            justify-content: center;
        }

        .image-wrapper {
            max-width: 24rem;
            /* object-fit: cover; */
            overflow: hidden;
            height: 100%;
        }


        .image-gallery img {
            position: relative;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }


        .main-image {
            width: 100%;
            border-radius: 8px;
            object-fit: cover;
        }

        .thumbnail-gallery {
            display: flex;
            gap: 10px;
        }

        .thumbnail-gallery img {
            width: 80px;
            height: 80px;
            border-radius: 4px;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .thumbnail-gallery img:hover {
            border-color: #007bff;
        }

        .product-info {


            display: flex;
            flex-direction: column;
            margin-left: 29px;
            /* align-items: center; */
            justify-content: space-between;
            gap: 15px;
        }

        .product-title {
            font-size: 24px;
            color: #333;
        }

        .product-category {
            font-size: 16px;
            color: #777;
        }

        .product-price {
            font-family: 'KaTeX_AMS';
            font-size: 20px;
            color: #e63946;
            font-weight: bold;
        }

        .product-description {
            font-size: 16px;
            color: #555;
            line-height: 1.5;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .product-additional-info {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-additional-info h2 {
            font-size: 20px;
            color: #333;
        }




        .productDetails {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .relatedProducts{
            display: flex
;
flex-direction: column;
    margin-top: 20px;
    align-items: center;
    justify-content: center;
    gap: 30px;
    height: 97vh;
        }

        .relatedProductCard{
            display: grid
;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    width: 100%;
    gap: 15px;
    padding: 0 20px;
        }
    
    
    </style>
<link rel="stylesheet" href="assets/style.css">


</head>



<body>
    <main class="product-page">

        <?php include '../Header/navbar.php' ?>
        <div class="productInfoContainer">

            <!-- Image Gallery Section -->
            <div class="image-gallery">
                <div class="image-wrapper">
                    <img src="<?php echo $product_image1; ?>" alt="Main Product Image">
                </div>


            </div>


            <!-- Product Info Section -->
            <div class="product-info">
                <div class="productDetails">

                    <h1 class="product-title"><?php echo $product_name1; ?></h1>
                    <p class="product-category"><?php echo $product_cate1; ?></p>
                    <p class="product-price">Rs <?php echo $product_price1; ?></p>
                    <p class="product-description">
                        <?php echo $product_desc1; ?>
                    </p>

                </div>
                <div class="action-buttons">
                <a href="addToCart.php?p_id=<?php echo $p_id?>"><button class="btn btn-primary">Add to Cart</button></a>
                    <a href="shoppingCart.php"> <button class="btn btn-secondary">View Cart</button></a>
                </div>

            </div>
        </div>

<div class="relatedProducts">
<div class="title">  <h2>Related Products</h2></div>
<div class="relatedProductCard">
<?php 

$sql_related="SELECT * FROM products WHERE product_id!=$p_id ORDER BY RAND() LIMIT 6";

$result_related = mysqli_query($conn, $sql_related);
while($row_related=mysqli_fetch_assoc($result_related)){



?>




 
  


<a href='../Product_Page/productInfo.php?p_id=<?php echo $row_related['product_id']?>'>
        <div class="card-wrapper">
            <div class="front-part">
                <div class="image-container">
                    <div class="image-cart-container">
                        <!-- Add to Cart button with onClick event -->
                      <i class="fa-solid fa-cart-shopping"></i> 
                    </div>
                    <img src="../Product_Page/<?php echo $row_related['image']; ?>" alt="Digital Effect Pack">
                </div>
            </div>
            <div class="bottom-part">
                <div class="price-wrapper">

                    <h4><?php echo $row_related['price']; ?></h4>

                </div>
                <div class="buy">
                    <h1><?php echo $row_related['product_name']; ?></h1>
                </div>
            </div>
        </div>
        </a>
        
      <?php
}
      ?>

       
        </div>
        </div>










    </main>
<script>

// Select all card wrappers
const cardWrappers = document.querySelectorAll('.card-wrapper');

cardWrappers.forEach(cardWrapper => {
    const priceWrapper = cardWrapper.querySelector('.price-wrapper'); // Find price-wrapper within the specific card

    if (priceWrapper) {
        cardWrapper.addEventListener('mouseenter', () => {
            priceWrapper.style.transition = 'none';
            priceWrapper.style.left = '-100%';
            priceWrapper.style.visibility = 'visible';
            priceWrapper.style.opacity = '1';

            setTimeout(() => {
                priceWrapper.style.transition = 'left 0.3s ease, opacity 0.3s ease';
                priceWrapper.style.left = '30px';
            }, 10);
        });

        cardWrapper.addEventListener('mouseleave', () => {
            priceWrapper.style.opacity = '0';
            priceWrapper.style.left = '150%';

            setTimeout(() => {
                priceWrapper.style.visibility = 'hidden';
            }, 300);
        });
    }
});


</script>

</body>

</html>