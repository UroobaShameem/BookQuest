<?php
// add_to_cart.php

// Start the session (make sure you call session_start() before any output)
session_start();

// Check if the book ID is provided in the query parameters
if (isset($_GET['book_id'])) {
    // Assuming the 'books' table has a primary key column named 'id'
    $book_id = $_GET['book_id'];

    // Initialize the cart array in the session if it doesn't exist yet
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Add the book ID to the cart array
    $_SESSION['cart'][] = $book_id;

    // Redirect back to the books.php page after adding the book to the cart
    header('Location: dashboard.php');
    exit();
} else {
    // If the book ID is not provided, handle the error (you can redirect to an error page, for example)
    echo 'Error: Book ID not provided.';
}
?>
