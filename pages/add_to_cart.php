<?php
// Check if the book_id is provided
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    // Assuming you have a database connection
    $conn = new mysqli('localhost', 'root', '', 'book_quest');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the book exists
    $checkBookQuery = "SELECT * FROM books WHERE book_id = $book_id";
    $checkBookResult = $conn->query($checkBookQuery);

    if ($checkBookResult->num_rows > 0) {
        // Book exists, add it to the cart
        $cart_id = uniqid(); // Generate a unique cart ID
        $quantity = 1; // Default quantity is 1

        // Insert the book into the cart table
        $insertQuery = "INSERT INTO cart (cart_id, book_id, quantity) VALUES ('$cart_id', '$book_id', $quantity)";
        if ($conn->query($insertQuery) === TRUE) {
            header("Location: cart.php");
        } else {
            echo "Error adding book to cart: " . $conn->error;
        }
    } else {
        echo "Book not found!";
    }

    $conn->close();
} else {
    echo "Invalid request!";
}
?>
