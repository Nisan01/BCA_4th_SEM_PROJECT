
<?php
include'../../includes/config.php';

if(!$conn){
echo"not connected";
}
else{

if($_SERVER['REQUEST_METHOD'] ==='POST'){

    $name=$_POST['name'];
    $email=$_POST['email'];
    $response=$_POST['response'];


$query=mysqli_query($conn,"INSERT INTO git_response (Name,Email,response_message) VALUES ('$name','$email','$response')");

if ($query) {
    echo "success"; 
} else {
    http_response_code(500); 
    echo "error";
}
















}













    echo"connected";
}






?>
