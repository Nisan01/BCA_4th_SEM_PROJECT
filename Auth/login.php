<?php
include '../includes/config.php';
session_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
//roles admins
    $stmt = $conn->prepare("SELECT * FROM `admins` WHERE Email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password === $row['Password']) {
            $_SESSION['admin_user_id'] = $row['id'];
            $_SESSION['admin_userName'] = $row['Email'];
            
            
       
            
            header('location:../Admin_Dashboard/dashboard.php');
            exit();
        }
    }

    //User role

    $stmt = $conn->prepare("SELECT * FROM `users` WHERE Email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password === $row['Password']) {
            $_SESSION['user_id'] = $row['Id'];
            $_SESSION['userName'] = $row['Firstname'];
            $_SESSION['user_email'] = $row['Email'];
            $_SESSION['user_name'] = $row['Firstname'] . ' ' . $row['Lastname'];

            $updateStatus = $conn->prepare("UPDATE `users` SET isActive = 1 WHERE Id = ?");
            $updateStatus->bind_param("i", $row['Id']);
            $updateStatus->execute();


            header('location:../homepage/homepage.php');
            exit();
        }
    }

    $message[] = 'Incorrect email or password';
}
?>






























<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
      
        :root {
            --primary-color: #000000;
            --secondary-color: #48ff00;
            --normal-color: #FFFF;
            --grey-color: #e0e0e0;
        }

        * {
            padding: 0;
            margin: 0;
            font-family: 'poppins',sans-serif;
        }

        body{
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url(../Images/fg_1.1.1.jpg);
        }
      
        input {
        height: 40px;
        width: 23vw;
        margin: 10px 0;
        border-radius: 20px;
        padding: 0 18px;
        background-color: rgba(62, 132, 132, 0.04);
        backdrop-filter: blur(20px);
        border: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
   
    }
::placeholder{
    color: white;
}
      #sign-in-btn {
        width: 9em;
        height: 3em;
        border-radius: 20px;
        border: none;
      }

.input-items{
    display: flex;
    flex-direction: column;
  
}

.form-container{
    width: 400px;
    height: 500px;
    border: 1px solid black;
    border-radius: 50px;
 
  
  
    position: relative;
   backdrop-filter: blur(9px);
}

.btn-items{
    display: flex;
    justify-content: center;
   align-items: center;
   gap: 10px;
   margin-top: 30px;
}

.btn-class2{
    width: 9em;
        height: 3em;
        border-radius: 20px;
        border: none;
        background-color: #23dcf888;
        cursor: pointer;

}

.btn-class1{
    width: 9em;
        height: 3em;
        border-radius: 20px;
        border: none;
        background-color: #0a0a0a88;
        cursor: pointer;
        color: #e0e0e0;

}

.btn:hover{
    opacity: 0.8;
}


.form-box{
    position:absolute;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    padding: 0px 25px; 
    transition: 0.3s;

}

.form-login{
    left: 50%;
}
.input-items{
    position: relative;
    
}

.icon{
    position: absolute;
    right: 10px;
    margin-top: 20px;
}



span{
    font-size: 30px;
    font-weight: bold;
    color: white;
}

.form-header{
    margin-top: 50px;
}


.message{
    margin: 5px 0;
    color:white;
    width: 100%;
    font-size: 15px;
    text-align: center;
    background-color: red;

}

    </style>
  </head>
  <body>
    <div class="form-container">
        <div class="form-wrapper">
<div class="btn-items">
    <button class="btn btn-class1" id="signin">SignIn</button>
    <a href="Register.php"><button class="btn btn-class2" id="register">Sign Up</button></a>
</div>

      <form action="" class="form-box form-login" method="POST" enctype="multipart/form-data">
<div class="form-header"><span>Sign In</span></div>

        <div class="input-items">
          <div class=" inputs input-box1">
            <input type="text" placeholder="Email" id="username" name="email"  required />
            <ion-icon name="person-outline" class="icon"></ion-icon>
          </div>
    

          <div class="inputsinput-box2">
            <input type="password" placeholder="password" id="password" name="password" required />
            <ion-icon name="lock-closed-outline" class="icon"></ion-icon>
          </div>
          <br />
        </div>

        <?php  
        if(isset($message)){

foreach($message as $message){
    echo' <div class="message">'.$message.'</div>';
}

        }

        ?>

        <button id="sign-in-btn" type="submit" name="submit">Login</button>
        <p id="forget-pass-wrapper"><a href="">Forget Password ?</a></p>
    </form>
    
    
    
    </div>
    </div>

  
    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
  </body>
</html>
