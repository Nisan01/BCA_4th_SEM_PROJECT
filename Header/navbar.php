<?php

include '../includes/config.php';
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$user = null;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = mysqli_query($conn, "SELECT * FROM `users` WHERE Id='$user_id'") or die('Query failed');
    $user = mysqli_fetch_assoc($query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creators Mela</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../Header/style.css">
</head>

<body>

    <?php if ($user): ?>
        <!-- Cart and logout button only for logged-in users -->
        <div class="cart-container">
            <i class="fa-solid fa-xmark" id="closeSidebar"></i>
            <div class="cartItemsContainer">
                <h2>Cart Items</h2>
                <div class="card-wrapper-container">

                    <?php
                    $cart = $_SESSION['cart'];
                    $total = 0;

                    foreach ($cart as $product_id) {
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

                        <div class="cart-item">
                            <!-- Display product image and name -->
                            <img src="../Product_Page/<?php echo $product_image; ?>">
                            <div class="cart-product-details">
                                <h3><?php echo $product_name; ?> </h3>
                                <p><?php echo $product_price; ?></p>
                            </div>
                        </div>

                    <?php
                        $total = $total + $product_price;
                    }
                    ?>
                </div>
            </div>
            <div class="bottomDiv">
                <span>Total Amount :<?php echo $total; ?>/-</span>
                <div class="cartItemsButton">
                    <a href="../checkOut/checkOut.php"> <button id="checkOut">Check Out</button></a>
                    <button id="viewCart"><a href="../Product_Page/shoppingCart.php">View Cart</a></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <nav>
        <div class="logo">
            <a href="../Homepage/Homepage.php"><img src="../Images/gfdg.png" alt="" height="100px"></a>
        </div>
        <ul class="ul-link">
            <li><a href="../Homepage/Homepage.php" class="active"><span>Home</span></a></li>
            <li><a href="../Product_Page/index.php"><span>Products</span></a></li>
            <li><a href="../Chat_Page/index.php"><span>Chat</span></a></li>
        </ul>





        <div class="right-items-container">

            <div class="profile-dashboard" id="profile-dash" ">
                <div class="profile-name">
                    <div class="change-profile-wrapper" id="profile-image-container">
                        <div class="profile-change" id="profile-change">
                            <li><a href="javascript:void(0);" onclick="document.getElementById('file-input').click();">Change Profile</a></li>
                        </div>

                        <div class="profile-image-container">
                            <?php
                            $defaultImagePath = '../Images/default_profile.png';
                            $imagePath = $defaultImagePath;

                            if (isset($user) && $user) {
                                $userImage = !empty($user['Image']) ? '../Images/' . htmlspecialchars($user['Image']) : $defaultImagePath;
                                if (file_exists($userImage)) {
                                    $imagePath = $userImage;
                                }
                            }
                            ?>
                            <img src="<?php echo $imagePath; ?>" alt="Profile Picture">
                        </div>

                    </div>
                    <h2 id="profile-name" contenteditable="false" onblur="updateUserInfo('name', this.innerText)">
                        <?= isset($user['Firstname']) && isset($user['Lastname']) ? $user['Firstname'] . ' ' . $user['Lastname'] : ''; ?>
                    </h2>
                    <img src="../Homepage/svg/pen-to-square-solid.svg" alt="" class="editItem" id="edit-icon-name" onclick="toggleEditable('profile-name')">

                    
                </div>

                <div class="user-data">
                    <div class="email-container">
                        <h3 id="user-email" contenteditable="false">
                            <?= isset($user['Email']) ? $user['Email'] : '' ?>
                        </h3>
                    </div>

                    <div class="experience-container">
                        <h4 id="user-experience" contenteditable="false" onblur="updateUserInfo('experience', this.innerText)">
                            <?= isset($user['Experience']) ? $user['Experience'] : '' ?>
                        </h4>
                        <img src="../Homepage/svg/pen-to-square-solid.svg" alt="" class="editItem"  id="edit-icon-experience" onclick="toggleEditable('user-experience')">


                    </div>
                    <button id="change-psw">Change Password</button>
                </div>

                <div class="login-logout-container">
                    <?php if ($user): ?>
                        <a href="../Auth/logout.php"><button class="logout-btn logout-btns" name="logout-btn">Logout</button></a>
                    
                    <?php endif; ?>
                </div>
            </div>

            <?php if (isset($user) && $user): ?>
                <?php
                $cart = $_SESSION['cart'];
                $count = count($cart);
                ?>

<img src="../Homepage/svg/cart-shopping-solid.svg" alt="" class="cartItem" id="toggleCartbar">

                <!-- <i class="fa-solid fa-cart-shopping" id="toggleCartbar"></i> -->
                <span id="cart-count"><?php echo $count; ?></span>
            <?php endif; ?>

            <i id="menu-icon" class="fa-solid fa-bars"></i>

            <div class="profile-container" id="profile-con" onclick="handleProfileClick()">
                <img src="<?php echo $imagePath; ?>" alt="Profile Picture">
            </div>
        </div>







    </nav>

    <input type="file" id="file-input" style="display: none;" onchange="uploadProfileImage()">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="../Header/main.js"></script>
    <script src="../Header/Notification.js"></script>

    <script>
        function uploadProfileImage() {
            const fileInput = document.getElementById('file-input');
            const file = fileInput.files[0];
            const formData = new FormData();
            formData.append('profile_image', file);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../Header/changeProfile.php', true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.querySelectorAll('.profile-image-container img').forEach(img => {
                            img.src = response.image_path + '?t=' + new Date().getTime();
                        });
                        document.querySelector('#profile-con img').src = response.image_path + '?t=' + new Date().getTime();

                        showNotification('Profile picture updated successfully!', 'success');
                    } else {
                        showNotification('Error: ' + response.error, 'error');
                    }
                } else {
                    showNotification('Error: Something went wrong!', 'error');
                }
            };

            xhr.send(formData);
        }

        function handleProfileClick() {
            <?php if (!isset($user)): ?>

                window.location.href = '../Auth/login.php';
            <?php endif; ?>
        }

        function toggleEditable(elementId) {
            const element = document.getElementById(elementId);
            if (element.contentEditable === "false") {
                element.contentEditable = "true";
                element.focus();
            } else {
                element.contentEditable = "false";
                updateUserInfo(elementId.split('-')[1], element.innerText);
            }
        }

        function updateUserInfo(field, value) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../Header/updateProfile.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        showNotification('Profile updated successfully!', 'success');
                    } else {
                        showNotification('Error: ' + response.error, 'error');
                    }
                } else {
                    showNotification('Error: Something went wrong!', 'error');
                }
            };

            xhr.send(`field=${field}&value=${encodeURIComponent(value)}`);
        }
    </script>
</body>

</html>