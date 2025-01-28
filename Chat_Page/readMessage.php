<?php
session_start();
include '../includes/config.php';

$q = "SELECT * FROM messages";
$rq = mysqli_query($conn, $q);

if ($rq) {
    if (mysqli_num_rows($rq) > 0) {
        while ($data = mysqli_fetch_assoc($rq)) {
            $sender_id = $data['Id'];
            $sender_query = "SELECT Firstname FROM users WHERE Id = $sender_id";
            $sender_result = mysqli_query($conn, $sender_query);

            $sender_name = ($sender_result && mysqli_num_rows($sender_result) > 0) 
                           ? mysqli_fetch_assoc($sender_result)['Firstname'] 
                           : "Unknown User";

            $timestamp_time = date("h:i A", strtotime($data['timestamp']));

            // Check if the current user is the sender
            if ($data['Id'] == $_SESSION["user_id"]) {
                ?>
                <div id="sender">
                    <span id="userName">Me</span>
                    <span id="messages"><?= htmlspecialchars($data["Message"]) ?></span>
                    <span id="timeStamp"><?= $timestamp_time ?></span>
                </div>
                <?php
            } else {
                // Check if the sender is an admin
                $admin_check_query = "SELECT id FROM admins WHERE id = $sender_id";
                $admin_check_result = mysqli_query($conn, $admin_check_query);

                if (mysqli_num_rows($admin_check_result) > 0) {
                    ?>
                    <div id="receiver">
                        <span id="userNameAdmin">Admin</span>
                        <span id="messagesAdmin"><?= htmlspecialchars($data["Message"]) ?></span>
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
        }
    } else {
        echo "<div class='no-messages'><p>Start the conversation!</p></div>";
    }
} else {
    echo "<h3>Error: " . mysqli_error($conn) . "</h3>";
}
?>
