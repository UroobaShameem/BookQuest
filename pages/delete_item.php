<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //check if cart_id is set
    if (isset($_POST['cart_id'])) {
        $cartId = $_POST['cart_id'];

        //database connection
        include_once 'config.php';

        // Delete the item from the cart
        $deleteQuery = "DELETE FROM cart WHERE cart_id = '$cartId'";
        if ($conn->query($deleteQuery) === TRUE) {
            echo "Item deleted successfully.";
        } else {
            echo "Error deleting item: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Invalid request!";
    }
} else {
    echo "Invalid request!";
}
?>
