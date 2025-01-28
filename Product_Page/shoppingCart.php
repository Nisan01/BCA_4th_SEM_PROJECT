<?php
session_start();
include '../includes/config.php';


if (isset($_SESSION["user_id"]) && isset($_SESSION["userName"])) {

       $cart= $_SESSION['cart'];



}
else {
    header("location:../auth/login.php");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Creators Mela</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
           
            margin: 0;
            padding: 0;
            background-color: #929c8f;
        }

a{
    text-decoration: none;
}
li{
    list-style: none;
}

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 2rem auto;
            background: #fff;
            padding: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .cart-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }
        .cart-table th, .cart-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        .cart-table th {
            background: #f7f7f7;
        }
        .cart-table img {
            object-fit: cover;
    width: 55px;
    border-radius: 8px;
        }
    
        .remove-btn {
            color: #ff4d4d;
            cursor: pointer;
        }
        .summary {
            margin-top: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .summary .total {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .summary button {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
        }
        .summary button:hover {
            background: #218838;
        }
        @media (max-width: 768px) {
            .cart-table th, .cart-table td {
                font-size: 0.9rem;
                padding: 0.5rem;
            }
            .summary {
                flex-direction: column;
                align-items: flex-start;
            }
            .summary button {
                margin-top: 1rem;
            }
        }
    </style>
</head>
<body>

 <?php include '../Header/navbar.php' ?>
    <div class="container">
        <div class="cart-title">Shopping Cart</div>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Price</th>
                   
                
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
<?php
$total=0;

foreach($cart as $product_id){

    $query = "SELECT*FROM products WHERE product_id='$product_id' ";
    $result = mysqli_query($conn, $query);


    if ($row = mysqli_fetch_assoc($result)) {
        $product_name = $row['product_name'];
        $product_price = $row['price'];
        $product_desc = $row['description'];
        $product_image = $row['image'];
        $product_cate = $row['category'];
    }

    ?>

    <tr>
    <td><img src="<?php echo $product_image; ?>" alt="Product Image" width="50" height="50"></td>
    <td>
<a href="productInfo.php?p_id=<?php echo $product_id;?>"><?php echo $product_name; ?></a>        


</td>
    <td><?php echo $product_price; ?></td>

    <td><a href="removeCart.php?p_id=<?php echo $product_id;?>"><i class="fas fa-trash remove-btn"></i></a></td>
</tr>
<?php

$total=$total+ $product_price;

}

?>
       
       
            

               
               
            </tbody>
           
          
        </table>
        <div class="summary">
            <div class="total">Total Amount :<?php echo $total?>/-</div>
            <a href="../checkOut/checkOut.php"><button>Checkout</button></a>
        </div>
    </div>
</body>
</html>
