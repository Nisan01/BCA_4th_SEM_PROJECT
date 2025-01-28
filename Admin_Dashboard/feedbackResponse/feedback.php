<?php
include '../../includes/config.php';


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT * FROM git_response";
$query = mysqli_query($conn, $sql);

if (!$query) {
    die("Query execution failed: " . mysqli_error($conn));
}


$responses = mysqli_fetch_all($query, MYSQLI_ASSOC);


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responses</title>
    <link rel="stylesheet" href="feedbackResponse/style.css">
</head>
<body>

    <div class="containerWrapper">
        <h2>Responses</h2>
        
        <table>
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Response Message</th>
                    <th>Response Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($responses)): ?>
                    <?php foreach ($responses as $response): ?>
                        <tr>
                            <td><?php echo $response['SN']; ?></td>
                            <td><?php echo $response['Name']; ?></td>
                            <td><?php echo $response['Email']; ?></td>
                            <td><?php echo $response['response_message']; ?></td>
                            <td><?php echo $response['response_timestamp']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No responses found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
