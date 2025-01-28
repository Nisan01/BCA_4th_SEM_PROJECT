<?php
session_start();
include '../../includes/config.php';

$query = "SELECT * FROM `messages`";
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_assoc($result)) {
            $sender_id = $data['Id']; // Corrected: Use 'Id' for sender_id
            $sender_name = "Admin"; // Default value for admins

            // First, check if the sender is an admin
            $admin_query = "SELECT `Email` FROM `admins` WHERE `Id` = '$sender_id'";
            $admin_result = mysqli_query($conn, $admin_query);

            if ($admin_result && mysqli_num_rows($admin_result) > 0) {
                // If the sender is an admin, use "Admin" as the name (or the admin's email)
                $sender_name = "Admin";
            } else {
                // If the sender is not an admin, check the users table
                $user_query = "SELECT `Firstname` FROM `users` WHERE `Id` = '$sender_id'";
                $user_result = mysqli_query($conn, $user_query);

                if ($user_result && mysqli_num_rows($user_result) > 0) {
                    $user_data = mysqli_fetch_assoc($user_result);
                    $sender_name = $user_data['Firstname'];
                }
            }

            // Format the timestamp
            $timestamp_time = "";
            if (!empty($data['timestamp'])) {
                $timestamp_time = date("h:i A", strtotime($data['timestamp']));
            }


if($data['Id'] == $_SESSION['admin_user_id']){





          
 ?>
<div id="sender">
    
        <span id="userName">Admin</span> <!-- Changed "Sender" to "You" -->
        
   
    <span id="messages"><?= htmlspecialchars($data["Message"]) ?></span>
    <span id="timeStamp"><?= $timestamp_time ?></span>
</div>
<?php
            } else {
?>
<div id="receiver">
  
        <span id="userName"><?= htmlspecialchars($sender_name) ?></span>
   
   
    <span id="messages"><?= htmlspecialchars($data["Message"]) ?></span>
    <span id="timeStamp"><?= $timestamp_time ?></span>
</div>
<?php
            }
        }







    } else {
        echo "<div class='no-messages'><p>Start the conversation!</p></div>";
    }
} else {
    echo "<h3>Error fetching messages: " . mysqli_error($conn) . "</h3>";
}
?>
