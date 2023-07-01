<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Assuming you have already established a database connection
    $conn = mysqli_connect("localhost", "root", "", "book_quest");

    // Query to insert the signup details into the "users" table
    $query = "INSERT INTO user (username, password, email) VALUES ('$username', '$password', '$email')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Successful signup
        header("Location: home.php");
        exit();
    } else {
        // Failed to insert user details, display an error message
        $error = "Failed to create an account";
    }

    mysqli_close($conn);
}
?>
