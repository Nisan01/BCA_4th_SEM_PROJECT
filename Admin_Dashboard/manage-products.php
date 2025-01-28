<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="../Admin_Dashboard/style.css">
    <script src="../jquery/jquery.js"></script>
    <style>
        /* Modal styles */
        #confirmModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 99;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        #confirmModal .modal-content {
            background-color: #fff;
    position: absolute;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
    width: 300px;
    top: 43%;
    right: 36%;
        }

        #confirmModal .modal-content button {
            margin: 10px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        #confirmModal .modal-content button#confirmYes {
            background-color: green;
            color: white;
        }

        #confirmModal .modal-content button#confirmNo {
            background-color: red;
            color: white;
        }
        #remove-message{
    display: none;
    position: absolute;
    top: 20.5rem;
    left: 58%;
    transform: translateX(-50%);
    padding: 4px 72px;
    border-radius: 5px;
    background-color: #4CAF50;
    color: #000000;
    font-size: 16px;
    z-index: 9999;
    opacity: 0.9;
}


    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Products</h1>  
        <button onclick="loadpage('addProductDashboard')" id="addbtn">Add Product</button>

        <!-- Product Table -->
        <table id="product-table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic product rows will be inserted here -->
            </tbody>
        </table>

        <!-- Confirmation Modal -->
        <div id="confirmModal">
            <div class="modal-content">
                <p>Are you sure you want to delete this product?</p>
                <button id="confirmYes">Yes</button>
                <button id="confirmNo">No</button>
            </div>
        </div>
        <div id="remove-message">
            Product Removed Successfully
        </div>
    </div>

    <script>
        // Function to load external page via AJAX
        function loadpage(page) {
            $.ajax({
                url: 'Manage_products/' + page + '.php',
                method: "GET",
                success: function(data) {
                    $('#content').html(data);
                }
            });
        }

        // Function to Load Products from Database
        function loadProducts() {
            fetch("../Admin_Dashboard/fetchProducts.php")
                .then(response => response.json())
                .then(data => {
                    const table = document.getElementById("product-table").getElementsByTagName("tbody")[0];
                    table.innerHTML = ""; // Clear table before inserting rows

                    if (data.length === 0) {
                        table.innerHTML = `<tr><td colspan="6">No products available.</td></tr>`;
                        return;
                    }

                    data.forEach(product => {
                        const row = table.insertRow();
                        row.innerHTML = `
                            <td>${product.product_id}</td>
                            <td>${product.product_name}</td>
                            <td>${product.description}</td>
                            <td>$${product.price}</td>
                            <td><img src="${product.image}" width="100" alt="Product Image"></td>
                            <td>
                                <button onclick="editProduct(${product.product_id})">Edit</button>
                                <button onclick="removeProduct(${product.product_id})">Remove</button>
                            </td>
                        `;
                    });
                });
        }

        // Function to edit a product
        function editProduct(productId) {
            $.ajax({
                url: 'Manage_products/editProduct.php',
                method: "GET",
                data: { id: productId },
                success: function(data) {
                    $("#content").html(data);
                }
            });
        }

        // Function to remove a product with custom confirmation dialog
        function removeProduct(productId) {
         
            $("#confirmModal").fadeIn();

            
            $("#confirmYes").on("click", function() {
                $.ajax({
                    url: 'Manage_products/removeProduct.php', 
                    method: 'POST',
                    data: { id: productId }, 
                    success: function(response) {
                        $("#remove-message").html('Product Removed Successfully')
                        .fadeIn(500)  // Fade in (500ms)
                        .delay(100)   // Wait for 100ms
                        .fadeOut(3000); 
                        if (response === 'success') {
                    // Show a success message
              

                    // Reload products after deletion
                    loadProducts();
                }

                       
                        $("#confirmModal").fadeOut();
                    }
                });
            });

           
            $("#confirmNo").on("click", function() {
                $("#confirmModal").fadeOut();
            });
        }

        // Load products on page load
        loadProducts();
    </script>
</body>
</html>
