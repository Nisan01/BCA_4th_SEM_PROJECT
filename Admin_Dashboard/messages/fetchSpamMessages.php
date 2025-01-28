<?php
include '../../includes/config.php'; // Adjust the path if necessary

// Define spam keywords
$spam_keywords = ['kill', 'murder', 'threat']; // Replace with your spam keywords

// Fetch messages from the database
$query = "SELECT messages.`M-id`, messages.Message, messages.timestamp, users.Firstname 
          FROM messages 
          JOIN users ON messages.Id = users.Id"; 

$result = mysqli_query($conn, $query);

$spam_messages = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($spam_keywords as $keyword) {
            if (stripos($row['Message'], $keyword) !== false) {
                $spam_messages[] = $row;
            
                break;
            }
        }
    }
}

// Return spam messages as JSON
header('Content-Type: application/json');
echo json_encode($spam_messages);
?>
