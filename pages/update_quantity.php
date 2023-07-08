<?php
// Check if the cart_id and quantity are provided
if (isset($_GET['cart_id']) && isset($_GET['quantity'])) {
    $cart_id = $_GET['cart_id'];
    $quantity = $_GET['quantity'];

    // Assuming you have a database connection
    include_once 'config.php';

    // Update the quantity in the cart table
    $updateQuery = "UPDATE cart SET quantity = $quantity WHERE cart_id = '$cart_id'";
    if ($conn->query($updateQuery) === TRUE) {
        echo "Quantity updated successfully!";
    } else {
        echo "Error updating quantity: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request!";
}
?>
