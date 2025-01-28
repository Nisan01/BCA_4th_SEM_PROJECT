<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <script src="../jquery/jquery.js"></script><!-- Add jQuery -->
    <style>
        /* Your existing styles */
        #addProductForm {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 463px;
            border: 1px solid #dfd5d5;
            padding: 10px;
            border-radius: 10px;
        }

        .form-container {
            height: 100%;
            width: 60%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 4px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group input[type="file"] {
            padding: 5px;
        }

        .form-actions {
            text-align: center;
        }

        .form-actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background: #007bff;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        .form-actions button:hover {
            background: #0056b3;
        }

        /* Notification Style */
        .notification {
            display: none;
            position: absolute;
    top: 17rem;
    filter: opacity(0.9);
            margin-top: 20px;
            padding: 10px;
            background-color: #28a745;
            color: white;
            text-align: center;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form id="addProductForm" action="addProduct.php" method="POST" enctype="multipart/form-data">
            <h2>Add Product</h2>
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" id="productName" name="productName" placeholder="Enter product name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3" placeholder="Enter product description" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" placeholder="Enter product price" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">Select Category</option>

                    <option value="premierePro">Premiere Pro</option>
                    <option value="afterEffects">After Effects</option>
                    <option value="davinciResolve">Davinci Resolve</option>
                    <option value="finalCutPro">Final Cut Pro</option>
                    <option value="photoshop">Photoshop</option>
                    <option value="motionGraphics">Motion Graphics</option>
                    <option value="overlays">Overlays</option>
                    <option value="freebies">Freebies</option>


                </select>
            </div>
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <div class="form-actions">
                <button type="submit">Add Product</button>
            </div>
        </form>
        
        <!-- Notification Container -->
        <div id="notification" class="notification">
            Product added successfully!
        </div>
    </div>

    <script>
        $(document).ready(function() {
    // Handle form submission
    $("#addProductForm").on("submit", function(event) {
        event.preventDefault();  

        var formData = new FormData(this);  

        $.ajax({
                    url: "Manage_products/addProduct.php",  
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log("Response from server: " + response); 
                        if (response.trim() === "success") {
                            // Show success notification
                            $("#notification")
                                .fadeIn(500)  
                                .delay(100)   
                                .fadeOut(3000); 

                            // Clear the form
                            $("#addProductForm")[0].reset();
                        } else {
                            alert("An error occurred: " + response); 
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX error: " + error);
                        alert("AJAX error: " + error);  
                    }
                });
            });
        });
    </script>
</body>
</html>
