<?php
// Check if the book_id is provided
if (isset($_POST['book_id'])) {
    $book_id = $_POST['book_id'];

    include 'config.php';

    // Check if the book is already in the cart
    $cartQuery = "SELECT * FROM cart WHERE book_id = $book_id";
    $cartResult = $conn->query($cartQuery);

    if ($cartResult->num_rows > 0) {
        // Update the quantity if the book is already in the cart
        $cartItem = $cartResult->fetch_assoc();
        $newQuantity = $cartItem['quantity'] + 1;
        $updateQuery = "UPDATE cart SET quantity = $newQuantity WHERE book_id = $book_id";
        if ($conn->query($updateQuery) === TRUE) {
            header("Location: cart.php");
        } else {
            echo "Error updating quantity: ";
        }
    } else {
        // Insert a new row in the cart table if the book is not in the cart
        $insertQuery = "INSERT INTO cart (book_id, quantity) VALUES ($book_id, 1)";
        if ($conn->query($insertQuery) === TRUE) {
            header("Location: cart.php");
        } else {
            echo "Error adding book to cart: "; $conn->error;
    }
}

    $conn->close();
} else {
    echo "Invalid request!";
}
?>
