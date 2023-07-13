<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Database connection
  include 'config.php';

  // Check if the email already exists
  $checkEmailQuery = "SELECT * FROM user WHERE email = '$email'";
  $checkEmailResult = $conn->query($checkEmailQuery);

  if ($checkEmailResult->num_rows > 0) {
    //if email already exists then show an error message
    echo "This email is already registered. Please use a different email.";
    $conn->close();
    exit;
  }

  //insert user data into the user table
  $insertUserQuery = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
  if ($conn->query($insertUserQuery) === TRUE) {
    // User registered successfully
    header("Location: home.php");
  } else {
    // Error in inserting user
    echo "Error signing up: " . $conn->error;
  }

  // Close the database connection
  $conn->close();
}
?>
