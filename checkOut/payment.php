
<?php

session_start();
include '../includes/config.php';

// Ensure the cart exists
if (empty($_SESSION['cart'])) {
    echo "Your cart is empty!";
    exit();
}

$cart = $_SESSION['cart'];
$user_email = $_SESSION['user_email'] ?? 'default@example.com';
$user_name = $_SESSION['user_name'] ?? 'Default User';
$user_id = $_SESSION['user_id'] ?? 0;

if ($user_id == 0) {
    echo "Please log in to place an order.";
    exit();
}

$checkout_product_id = json_encode($cart);

// Check if an order with the same checkout_product_id already exists for this user
$check_order_query = "SELECT order_id, total_price FROM orders WHERE checkout_product_id = '$checkout_product_id' AND id = '$user_id'";
$check_order_result = mysqli_query($conn, $check_order_query);

if (mysqli_num_rows($check_order_result) > 0) {
    // If the order already exists, fetch its details
    $existing_order = mysqli_fetch_assoc($check_order_result);

    // Fetch order_id and total_price
    $order_id = $existing_order['order_id'];
    $total_amount = $existing_order['total_price'];


} 

?>











<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout Page</title>
  <style>
    body {

      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
    }

    .checkout-container {
      justify-content: space-between;
      display: flex;
      width: 100%;
      padding: 20px;
 
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      overflow: hidden;
    }

    .product-summary {
      padding: 20px;
      max-height: 517px;
      width: 60%;
      background-color: #e2e2e2;
      overflow: hidden;
      border-bottom: 1px solid #ddd;
    }
    .product-list{
      height: 25rem;
    overflow-y: scroll;
    scrollbar-width: none;
    }

    .product-summary h2 {
      font-size: 1.2em;
      margin-bottom: 10px;
    }

    .product-list {
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .product-item {
      display: flex;
      justify-content: space-between;
      padding: 10px 0;
      border-bottom: 1px dashed #ccc;
      align-items: center;
    }

    .product-item:last-child {
      border-bottom: none;
    }

    .product-summary .total {
      text-align: right;
    display: flex
;
    /* margin-top: 1px; */
    font-size: 1.2em;
    font-weight: bold;
    border-top: 1px solid #c5c5c5;
    /* flex-direction: column; */
    align-items: center;
    justify-content: space-between;
    }

    .billing-details {
      padding: 0 20px;
      width: 40%;
    }

    .billing-details h2 {
      font-size: 1.2em;
      margin: 0;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .form-group input,
    .form-group select {
      width: 90%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 1em;
    }

    .payment-methods {
      margin-top: 20px;
    }

    .payment-methods h2 {
      font-size: 1.2em;
      margin-bottom: 10px;
    }

    .payment-icons {
      display: flex;
      gap: 10px;
    }

    .payment-icons img {
      width: 96px;
      margin-left: -8px;
      height: auto;
      cursor: pointer;
    }

    .submit-button {
      margin-top: 20px;
      text-align: center;
    }

    .submit-button button {
      background: #28a745;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      font-size: 1em;
      cursor: pointer;
    }

    .submit-button button:hover {
      background: #218838;
    }


    .headingTitle h1 {
      margin: 4px;
      text-align: center;
    }

.productContImg img{
  object-fit: cover;
    height: 100%;
    width: 100%;

}


.productContImg{
  height: 30px;
    overflow: hidden;
    width: 30px;
}

span#totalPrice{
  font-style: italic;
}

  </style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/hmac-sha256.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/enc-base64.min.js"></script>
</head>

<body>
  <div class="headingTitle">
    <h1>Checkout</h1>
  </div>
  <div class="checkout-container">

    <div class="product-summary">
      <h2>Product Summary</h2>
      <ul class="product-list">

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


<li class="product-item">
  <div class="productContImg"> <img src="../Product_Page/<?php echo$product_image?>" alt=""></div>
 
          <span>
        
            <a href="../Product_Page/productInfo.php?p_id=<?php echo $product_id;?>"><?php echo $product_name; ?></a>
          </span>
          <span><?php echo$product_price;?></span>
        </li>
<?php
$total=$total+$product_price;
}

$total_amount=$total;

?>




       
      </ul>
    
      
        <div class="total">
        <p id="total">Total:</p> 
        <span id="totalPrice">NPR <?php echo$total;?>/-</span>  
      
      </div>
      
  
      
    </div>
    


   
    <div class="billing-details">
      <h2>Billing Details</h2>
      <div class="form-group">
        <label for="firstname">Full Name</label>
        <input type="text" id="firstname" placeholder="Enter your first name" value="<?php echo$user_name; ?>">
      </div>
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" placeholder="Enter your email" value="<?php echo$user_email; ?>">
      </div>
      <div class="form-group">
        <label for="country">Country</label>
        <select id="country">
          <option value="">Select Country</option>
          <option value="nepal">Nepal</option>
          <option value="india">India</option>
          <option value="usa">USA</option>
        </select>
      </div>
      <div class="form-group">
        <label for="town">Town</label>
        <input type="text" id="town" placeholder="Enter your town">
      </div>
      <div class="form-group">
        <label for="city">City</label>
        <input type="text" id="city" placeholder="Enter your city">
      </div>

      <!-- Payment Methods Section -->
      <div class="payment-methods">
        <h2>Payment Methods</h2>
        <div class="payment-icons">
          <img src="pngs/esewa.png" alt="Esewa">

        </div>
      </div>



<!-- Proceed to Payment Button -->
<div class="submit-button">
  <button type="button" onclick="submitPaymentForm()">Proceed to Payment</button>
</div>

<!-- Hidden eSewa Payment Form -->
<form id="paymentForm" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST" style="display:none;">
  <input type="text" id="amount" name="amount" value="<?php echo $total_amount;?>" class="form" required><br>
  <input type="text" id="tax_amount" name="tax_amount" value="0" class="form" required>
  <input type="text" id="total_amount" name="total_amount" value="<?php echo $total_amount;?>" class="form" required>
  <input type="text" id="transaction_uuid" name="transaction_uuid" value="<?php echo $order_id;?>" class="form" required>
  <input type="text" id="product_code" name="product_code" value="EPAYTEST" class="form" required>
  <input type="text" id="product_service_charge" name="product_service_charge" value="0" class="form" required>
  <input type="text" id="product_delivery_charge" name="product_delivery_charge" value="0" class="form" required>
  <input type="text" id="success_url" name="success_url" value="http://localhost/php/Creators_Mela/checkOut/payment/esewa_payment_success.php" class="form" required>
  <input type="text" id="failure_url" name="failure_url" value="http://localhost/php/Creators_Mela/checkOut/payment/esewa_payment_failed.php" class="form" required>
  <input type="text" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" class="form" required>
  <input type="text" id="signature" name="signature" value="4Ov7pCI1zIOdwtV2BRMUNjz1upIlT/COTxfLhWvVurE=" class="form" required>
</form>









      </div>
    </div>
  </div>

  <script>
	 

	
            function generateSignature() {
                  var total_amount = document.getElementById("total_amount").value;
                  var transaction_uuid = document.getElementById("transaction_uuid").value;
                  var product_code = document.getElementById("product_code").value;
                 
                  var hash = CryptoJS.HmacSHA256(`total_amount=${total_amount},transaction_uuid=${transaction_uuid},product_code=${product_code}`,'8gBm/:&EnhH.1/q');//secret key for 
                  var hashInBase64 = CryptoJS.enc.Base64.stringify(hash);
                  document.getElementById("signature").value = hashInBase64;
            }

         
            document.getElementById("total_amount").addEventListener("input", generateSignature);
            document.getElementById("transaction_uuid").addEventListener("input", generateSignature);
            document.getElementById("product_code").addEventListener("input", generateSignature);
         
            function submitPaymentForm() {
    // Generate the signature (this is triggered when you click the button)
    generateSignature();

    // Submit the form
    document.getElementById("paymentForm").submit();
            }


      </script>

</body>


</html>