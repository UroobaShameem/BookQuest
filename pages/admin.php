<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="asset/index-style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">  
  <title>Admin Login</title>
</head>

<?php
session_start();
// Connect to the database
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //check if username and password are given
    if (isset($_POST["username"])) {
        $username = $_POST["username"];
    } else {
        exit("Username is required");
    }

    if (isset($_POST["password"])) {
        $password = $_POST["password"];
    } else {
        exit("Password is required");
    }

    // Get the username and password
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the username contains special characters
    $username = mysqli_real_escape_string($conn, $username);

    //check if the username is correct
    $query = "SELECT * FROM admin_bs WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Check if any rows were returned
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if ($password == $user["password"]) {
                // Successful login
                $_SESSION["username"] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid password";
            }
        } else {
            $error = "Invalid username";
        }
    } else {
        $error = "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<body>
    <div class="container">
        <div class="center-div">
            <div class="center-content">
            <form method="POST" action="admin.php">
                <div class="mb-3">
                  <label for="loginUsername" class="form-label login">Username</label>
                  <input type="text" class="form-control" name="username" placeholder="Enter your username">
                </div>
                <div class="mb-3">
                  <label for="loginPassword" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Enter your password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
              </form>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>
