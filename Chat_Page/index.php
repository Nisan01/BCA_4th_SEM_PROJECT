<?php

session_start();
include '../includes/config.php'; 


if (isset($_SESSION["user_id"]) && isset($_SESSION["userName"])) {

  // Fetch all users
  $query = "SELECT Id, Firstname, Image, isActive FROM users ORDER BY Id = {$_SESSION['user_id']} DESC, isActive DESC";
  $result = mysqli_query($conn, $query);

  $users = [];
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $users[] = $row;
    }
  }
} else {
  header("location:../auth/login.php");
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="icon" type="png" href="../Assets/favIcon/android-chrome-512x512.png">
</head>

<body>


  <div class="chat-interface-wrapper">
    <?php include '../Header/navbar.php' ?>
    <div class="container">

      <div class="left-panel">
        <h1 class="users-head">Users</h1>

        <div class="load-users">
          <?php foreach ($users as $user): ?>
            <?php
            $profile_image = !empty($user['Image']) ? $user['Image'] : '../Images/default_profile.png';
            $extra_class = '';
            if ($user['Id'] == $_SESSION['user_id']) {
              $extra_class = 'logged-in';
            } elseif ($user['isActive']) {
              $extra_class = 'active-user';
            }
            ?>
            <div class="u1 <?= htmlspecialchars($extra_class) ?>">
              <div class="img-container">
                <img src="../uploaded_img/<?= htmlspecialchars($profile_image) ?>" alt="Profile Picture" />
              </div>
              <span id="username"><?= htmlspecialchars($user['Firstname']) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>



      <div class="right-panel">
        <h1 class="chat-head">Chat <span id="hub-text">Hub</span></h1>
        <div class="messages">


          <p>
            <span>User</span>
            random message is here

          </p>
          <p>
            <span>User</span>
            random message is here

          </p>
          <p class="sender">
            <span>User</span>
            random message is here

          </p>




        </div>
        <form action="#" method="POST" onsubmit="return false;">
          <input type="text" name="message" placeholder="Enter the Message" id="input_msg" />
          <button id="send-btn" type="button" onclick="sendMessage()">Send</button>
        </form>
      </div>
    </div>


  </div>
</body>
<script src="js/main.js"></script>

</html>