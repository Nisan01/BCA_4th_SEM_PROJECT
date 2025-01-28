<?php
session_start();

include '../includes/config.php'; 

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
    <title>Product Page</title>
    <link rel="icon" type="png" href="../Assets/favIcon/android-chrome-512x512.png">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.css">
</head>

<body>
<div id="main">
<div class="page-wrapper">
<?php include '../Header/navbar.php'?>
<div class="navbar">
    <ul>
        <li data-category="all" class="active"><a href="#">All</a></li>
        <li data-category="premierePro"><a href="#">Premiere Pro</a></li>
        <li data-category="afterEffects"><a href="#">After Effects</a></li>
        <li data-category="davinciResolve"><a href="#">Davinci Resolve</a></li>
        <li data-category="finalCutPro"><a href="#">Final Cut Pro</a></li>
        <li data-category="photoshop"><a href="#">Photoshop</a></li>
        <li data-category="motionGraphics"><a href="#">Motion Graphics</a></li>
        <li data-category="overlays"><a href="#">overlays</a></li>

        <li data-category="freebies"><a href="#">Freebies</a></li>
    </ul>
</div>

<div class="searchProducts-wrapper">

    <div class="searchbar-container">
        <input type="text" class="form-control" id="live_search" autocomplete="off" placeholder="Search...">
    </div>
  
    <div id="searchresults"></div>
</div>
</div>
</div>


<script src="../jquery/jquery.js"></script>


<script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.min.js"></script>

<script src="assets/main.js"></script>

<script type="text/javascript">
  $(document).ready(function () {

    const mainElement = document.querySelector("#main");
    let scroll = null;

    if (mainElement) {
        scroll = new LocomotiveScroll({
            el: mainElement,   
            smooth: true, 
            lerp:0.04,     
        });
    } else {
        console.error('Main element not found!');
    }

    function fetchProducts(input = "", category = "all") {
        $.ajax({
            url: 'livesearch.php',
            method: 'POST',
            data: { input: input, category: category },
            success: function (data) {
                $("#searchresults").html(data);

                const productContainers = document.querySelectorAll('.card-wrapper');
                const priceWrappers = document.querySelectorAll('.price-wrapper');

                productContainers.forEach((container, index) => {
                    const priceWrapper = priceWrappers[index];

                    container.addEventListener('mouseenter', () => {
                        if (priceWrapper) {
                            priceWrapper.style.transition = 'none';
                            priceWrapper.style.left = '-100%';
                            priceWrapper.style.visibility = 'visible';
                            priceWrapper.style.opacity = '1';

                            setTimeout(() => {
                                priceWrapper.style.transition = 'left 0.3s ease, opacity 0.3s ease';
                                priceWrapper.style.left = '30px';
                            }, 10);
                        }
                    });

                    container.addEventListener('mouseleave', () => {
                        if (priceWrapper) {
                            priceWrapper.style.opacity = '0';
                            priceWrapper.style.left = '150%';

                            setTimeout(() => {
                                priceWrapper.style.visibility = 'hidden';
                            }, 300);
                        }
                    });
                });

                // After the content is loaded, update Locomotive Scroll
                if (scroll) {
                    scroll.update();
                }
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }

    fetchProducts();

    $("#live_search").keyup(function () {
        const input = $(this).val().trim();
        const activeCategory = $(".navbar ul li.active").data("category");
        fetchProducts(input, activeCategory);
    });

    $(".navbar ul li").click(function () {
        $(".navbar ul li").removeClass("active");
        $(this).addClass("active");
        const category = $(this).data("category");
        const input = $("#live_search").val().trim();
        fetchProducts(input, category);
    });
});

</script>

</body>

</html>



