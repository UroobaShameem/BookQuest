<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.html");
    exit();
}

// Retrieve the logged-in username from the session
$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $username; ?></h1>
    <p>This is the dashboard page. You are logged in.</p>
</body>
</html>
