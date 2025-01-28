<?php


include '../includes/config.php';

if (isset($_POST['submit'])) {

    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $experience=mysqli_real_escape_string($conn,$_POST['experience']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $repassword = mysqli_real_escape_string($conn, $_POST['repassword']);

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image; 

    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email='$email' && password='$password'") or die("query failed");

    if (mysqli_num_rows($select) > 0) {

        $message[] = 'User already exists';
    } else {
        if ($password != $repassword) {
            $message[] = 'Passwords donot match';
        } elseif ($image_size > 2000000) {
            $message[] = 'Image size too large';
        } else {
            $insert = mysqli_query($conn, "INSERT INTO `users` (firstname,lastname,email,password,image,experience) VALUES('$firstname','$lastname','$email','$password','$image','$experience')") or die('query failed');

            if ($insert) {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Registered Successfully';
                header('location:login.php');
            } else {
                $message = 'Registration failed';
            }
        }
    }
}








?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .form-container {
            height: 100vh;
            width: 100%;
            background-color: rgb(179, 186, 186);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container form {

            display: flex;
            align-items: center;
            flex-direction: column;
            background-color: rgb(104, 110, 109);
            padding: 20px;
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.121) 0px 1px 3px, rgba(0, 0, 0, 3) 0px 1px 2px;

        }

        form input {
            border: none;

            padding: 7px;
            width: 100%;
            border-radius: 5px;
            background-color: rgb(228, 247, 247);

        }

        form input::placeholder {
            padding-left: 5px;
        }

        .btn {
            cursor: pointer;
            width: 50%;
        }

h2{
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    text-transform: uppercase;
    font-weight: bold;
    color: white;
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

        <form action="" method="POST" enctype="multipart/form-data">
            <h2>Register Now</h2>
            <?php 
if(isset($message)){
    foreach ($message as $message){
        echo' <div class="message">'.$message.'</div> ';
    }
}
            ?>

            <input type="text" name="firstname" placeholder="First Name" class="Box" required><br>
            <input type="text" name="lastname" placeholder="Last Name" class="Box" required><br>
            <input type="email" name="email" placeholder="Email" class="Box" required><br>
            <input type="text" name="experience" placeholder="Experience or Field" class="Box" required><br>


            <input type="text" name="password" placeholder="Password" class="Box" required><br>
            <input type="text" name="repassword" placeholder="Re-type password" class="Box" required><br>

            <input type="file" name="image" class="Box" accept="image/jpg,image/jpg,image/png"><br>

            <input type="submit" name="submit" value="Register Now" class="btn">
            <p>Already have an account ?<a href="login.php">Login Now</a></p>




        </form>

    </div>



</body>

</html>