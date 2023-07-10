<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required parameters are provided
    if (isset($_POST['cart_id']) && isset($_POST['quantity'])) {
        $cart_id = $_POST['cart_id'];
        $quantity = $_POST['quantity'];

        // Assuming you have a database connection
        include_once 'config.php';

        // Update the quantity in the cart
        $updateQuery = "UPDATE cart SET quantity = $quantity WHERE cart_id = '$cart_id'";
        if ($conn->query($updateQuery) === TRUE) {
            // Calculate the new subtotal
            $getBookQuery = "SELECT b.price, c.quantity FROM cart c INNER JOIN books b ON c.book_id = b.book_id WHERE c.cart_id = '$cart_id'";
            $getBookResult = $conn->query($getBookQuery);
            if ($getBookResult->num_rows > 0) {
                $book = $getBookResult->fetch_assoc();
                $subtotal = $book['price'] * $quantity;

                // Return the updated subtotal
                echo $subtotal;
            } else {
                echo "Error retrieving book information";
            }
        } else {
            echo "Error updating quantity: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Invalid request!";
    }
} else {
    echo "Invalid request!";
}
?>
