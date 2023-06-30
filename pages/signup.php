<?php
include 'config.php';

if (isset($_POST['submit'])) {
    // Retrieve form data and sanitize inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $userType = $_POST['user_type'];

    // Perform validation and error checking
    $errors = [];

    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
        $errors[] = 'All fields are required.';
    }

    if ($password !== $confirmPassword) {
        $errors[] = 'Passwords do not match.';
    }

    if (count($errors) === 0) {
        // Check if the user already exists
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $errors[] = 'User already exists.';
        } else {
            // Hash the password securely
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the user into the database
            $query = "INSERT INTO users (name, email, password, user_type) VALUES ('$name', '$email', '$hashedPassword', '$userType')";
            $insertResult = mysqli_query($conn, $query);

            if ($insertResult) {
                // Registration successful
                header('Location: login.php');
                exit();
            } else {
                $errors[] = 'Registration failed. Please try again later.';
            }
        }
    }

    // Handle and display errors
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}

?>
