<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Assuming you have a database connection
  include_once 'config.php';

  // Check if the email already exists
  $checkEmailQuery = "SELECT * FROM user WHERE email = '$email'";
  $checkEmailResult = $conn->query($checkEmailQuery);

  if ($checkEmailResult->num_rows > 0) {
    // Email already exists, show an error message
    echo "This email is already registered. Please use a different email.";
    $conn->close();
    exit;
  }

  // Insert the user into the database
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
