<?php
// Check if the cart_id is provided
if (isset($_GET['cart_id'])) {
    $cart_id = $_GET['cart_id'];

    // Assuming you have a database connection
    include_once 'config.php';

    // Delete the item from the cart table
    $deleteQuery = "DELETE FROM cart WHERE cart_id = '$cart_id'";
    if ($conn->query($deleteQuery) === TRUE) {
        echo "Item deleted successfully!";
    } else {
        echo "Error deleting item: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request!";
}
?>
