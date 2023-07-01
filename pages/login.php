<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the username and password have been set
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

    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "book_quest");

    // Check if the database connection is successful
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }


    $username = mysqli_real_escape_string($conn, $username);

    // Query to validate the login details
    $query = "SELECT * FROM user WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Check if any rows were returned
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if ($password == $user["password"]) {
                // Successful login
                $_SESSION["username"] = $username;
                header("Location: home.php");
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
