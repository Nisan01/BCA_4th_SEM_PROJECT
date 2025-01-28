<?php
include '../../includes/config.php';


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT * FROM users";
$query = mysqli_query($conn, $sql);


if (!$query) {
    die("Query execution failed: " . mysqli_error($conn));
}


$responses = mysqli_fetch_all($query, MYSQLI_ASSOC);


$totalUsersSql = "SELECT COUNT(*) AS totalUsers FROM users";
$totalUsersQuery = mysqli_query($conn, $totalUsersSql);


if (!$totalUsersQuery) {
    die("Query execution failed: " . mysqli_error($conn));
}

// Fetch total number of users
$totalUsers = mysqli_fetch_assoc($totalUsersQuery)['totalUsers'];


$totalActiveUsersSql = "SELECT COUNT(*) AS totalActiveUsers FROM users WHERE isActive = 1";
$totalActiveUsersQuery = mysqli_query($conn, $totalActiveUsersSql);


if (!$totalActiveUsersQuery) {
    die("Query execution failed: " . mysqli_error($conn));
}

// Fetch total number of active users
$totalActiveUsers = mysqli_fetch_assoc($totalActiveUsersQuery)['totalActiveUsers'];


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="customerInfo/style2.css">
</head>
<body>
    <div class="userInfoContainer">
        <div class="countUsers">
            <span id="totalCount">Total Users: <?php echo $totalUsers; ?></span>
            <span id="totalCountActive">Total Active Users: <?php echo $totalActiveUsers; ?></span>
        </div> <h2>Users</h2>
        <div class="tableWrapper">
       
        <table>
            <thead>
                <tr>
                    <th>User Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Experience</th>
                    <th>Active</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($responses as $response): ?>
                    <tr>
                        <td><?php echo $response['Id']; ?></td>
                        <td><?php echo $response['Firstname']; ?></td>
                        <td><?php echo $response['Lastname']; ?></td>
                        <td><?php echo $response['Email']; ?></td>
                        <td><?php echo $response['Experience']; ?></td>
                        <td class="<?php echo $response['isActive'] == 1 ? '' : 'inactive'; ?>">
                      <?php echo $response['isActive'] == 1 ? 'Active' : 'Inactive'; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>
