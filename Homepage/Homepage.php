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
  <title>Creators Mela</title>
  <link rel="icon" type="png" href="../Assets/favIcon/android-chrome-512x512.png">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="../jquery/twentytwenty-master/css/twentytwenty.css">
  <link rel="stylesheet" href="../Fonts/monsterrat/style.css">

</head>

<body>
  <div id="main"  data-scroll-container>
    <div id="page1" data-scroll>
      <?php include '../Header/navbar.php' ?>

      
  <div class="video-container">
    <video autoplay loop muted playsinline class="navbar-video">
      <source src="video/europe.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <div class="overlay-text">Transform your ideas faster with our time-saving assets.</div>

  </div>



      

  
    </div>

    <div id="page2" data-scroll>

    <section id="welcome">
        <img src="images/bundlePack1.png" class="leftImg boxImg" alt="" data-scroll data-scroll-speed="-2" data-scroll-direction="horizontal">
        <img src="images/bundleCinematic.png" class="leftImgDown boxImg" alt="" data-scroll data-scroll-speed="-2" data-scroll-direction="up">
        <img src="images/overlays.png" class="rightImg boxImg" alt="" data-scroll data-scroll-speed="-1" data-scroll-direction="down">
        <img src="images/pack.png" class="rightImgdown boxImg" alt="" data-scroll data-scroll-speed="-2" data-scroll-direction="horizontal">
        <div class="bodyWrapper">
          <h1 class="welcomeTitle">Welcome to Creators Mela</h1>
        </div>
        <div class="imageContainer">
          <img src="images/collectionpic2.png" alt="">
        </div>
        <p>Empowering creators, one digital product at a time.</p>
        <a href="../Chat_Page/index.php" class="btn">Lets Interact</a>
      </section>

    </div>
<div id="page3" data-scroll>

<div class="headerText">
  <div class="subWrapper"><h3>unlease</h3>
  <h2>Your</h2></div>
  
  <h1>CREATIVITY</h1>
  

</div>
<div class="cardContainer">
  <div class="cardWrapper">
        <div class="card card1">
            <img src="images/premierePro.jpg" alt="">
            <div class="cardDetails">
           <p> Premiere Pro helps with professional video editing, offering tools for cutting, color correction, and audio adjustments to create polished videos.                </p>
</p>  <a href="">Read More</a>
            </div>
            
        </div>
        <div class="cardName">
              <h2>Adobe Premiere Pro</h2>
            </div>
        </div>
  <div class="cardWrapper">
        <div class="card card2">
        <img src="images/afterEffects.jpg" alt="">
            <div class="cardDetails">
                <p>After Effects helps create stunning motion graphics and visual effects, perfect for animations and dynamic visuals.
                </p>
                <a href="">Read More</a>
            </div>
            
        </div>
        <div class="cardName">
              <h2>After Effects</h2>
            </div>
        </div>
  <div class="cardWrapper">
        <div class="card card3">
        <img src="images/davinci.jpg" alt="">
            <div class="cardDetails">
                <p>DaVinci Resolve is a powerful tool for video editing and professional color grading, ideal for perfecting your films' look
                </p>
                <a href="">Read More</a>
            </div>
            
        </div>
        <div class="cardName">
              <h2>Davinci Resolve</h2>
            </div>
        </div>
  <div class="cardWrapper">
        <div class="card card4">
        <img src="images/finalCut.jpg" alt="">
            <div class="cardDetails">
                <p>Final Cut Pro, designed for Mac users, offers fast, efficient video editing, making creative projects smooth and professional
                </p>
                <a href="">Read More</a>
            </div>
            
        </div>
        <div class="cardName">
              <h2>Final Cut Pro</h2>
            </div>
        </div>
  <div class="cardWrapper">
        <div class="card card5">
        <img src="images/photoshop.jpg" alt="">
            <div class="cardDetails">
                <p>Photoshop allows effortless photo editing and graphic design, from retouching images to creating digital artwork.
                </p>
                <a href="">Read More</a>
            </div>
            
        </div>
        <div class="cardName">
              <h2>Adobe Photoshop</h2>
            </div>
        </div>







    

    </div>

<p id="footerText">To All Platforms</p>
</div>

<div id="page4" data-scroll>
<section class="before-after">
  <div class="headingContainer">
    <h2>Heard of Luts ?</h2>
    <p>A LUT adjusts colors to bring a unique, artistic vibe to your footage, enhancing the overall feel and emotion</p>
  </div>
      
  <div class="beforeAfterWrapper">
  <div class="twentytwenty-container" id="horizontal">
            <img src="../Homepage/images/before1.png" alt="Before">
            <img src="../Homepage/images/after1.png" alt="After">
        </div>
<div class="textDescription">
  <div class="bodyWrapper">
    <h3>2025 January Update</h3>
    <h2>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi, nam.</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
      Iure dicta reiciendis ratione explicabo reprehenderit illum ex? Temporibus exercitationem accusantium recusandae!</p>
      <button id="explore"><a href="../Product_Page/index.php">Explore</a></button>
  </div>
</div>

  </div>


       
    </section>

  
</div>
<div class="footerContainer" data-scroll>
        <div class="wrapperFooter">
          <div class="leftContainer">
            <div class="textWrapper">
              <div class="leftText">
                <h1>WHY</h1>
                <h3>Pay More <span id="questionMark">?</span></h3>
              </div>
              <div class="rightText">
                <img src="footer/shopping.png" alt="Shopping Icon" width="50">
                <h2>SHOP SMART SAVE</h2>
                <span>BIG</span>
              </div>
            </div>
          </div>

          <div class="rightContainer">
            <div class="aboutUs">
              <h2>About Us</h2>
              <p>We bring you premium products that fit your budget. Quality and affordability guaranteed.</p>
            </div>
            <div class="getinTouch">
              <h2>Get in Touch</h2>
              <form id="footerForm" method="post">
                <input type="text" placeholder="Your Name" name="name" required>
                <input type="email" placeholder="Your Email" name="email" required>
                <textarea placeholder="Any Messages" name="response" required></textarea>
                <button type="submit" id="gitResponseBtn" required>submit</button>
              </form>
             
            </div>
          </div>
        </div>

        <div id="social-media">
          <h4>Follow Us</h4>
          <ul>
            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>



  </div>
  <div class="hookImage">
    <img src="../Homepage/images/transitionsPack.jpg" alt="">
  </div>
  <!-- External JS Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.js"></script>

  
<script src="../jquery/jquery.js"></script>  
  <script src="../jquery/twentytwenty-master/js/jquery.event.move.js"></script>
    <script src="../jquery/twentytwenty-master/js/jquery.twentytwenty.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <script>
        $("#page4 #horizontal").twentytwenty();
    </script>

  <script src="../Header/Notification.js"></script>
 <script  src="./js/main.js"></script>




  <script>
    
   
    $(document).ready(function() {
      
  
     

      $('#footerForm').submit(function(e) {
        e.preventDefault(); 

        console.log("Form submitted, sending data via AJAX...");
        $.ajax({
          type: 'POST',
          url: 'php_scripts/git_response.php', // Adjust path if needed
          data: $(this).serialize(),
          success: function(response) {
            $('#footerForm')[0].reset();
            showNotification('Submitted Successfully', 'success');
            console.log("AJAX Success:", response);
          },
          error: function() {
            showNotification('Error', 'error');
            console.error("AJAX Error");
          }
        });
      });
    });
  </script>
</body>

</html>
