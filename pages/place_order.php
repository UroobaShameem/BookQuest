<?php

// Custom function to generate a unique order ID
function generateOrderID() {
    $length = 8;
    $orderID = '';
  
    // Generate a random number order ID
    for ($i = 0; $i < $length; $i++) {
        $orderID .= mt_rand(0, 9);
    }
  
    return $orderID;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Assuming you have a database connection
    include_once 'config.php';

    // Generate a unique order ID
    $orderId = generateOrderID();

    // Insert the order details into the orders table
    $insertOrderQuery = "INSERT INTO orders (name, email, address) VALUES ('$name', '$email', '$address')";
    if ($conn->query($insertOrderQuery) === TRUE) {
        // Get the last inserted order ID
        $orderQuery = "SELECT MAX(order_id) AS last_order_id FROM orders";
        $orderResult = $conn->query($orderQuery);
        $orderRow = $orderResult->fetch_assoc();
        $orderId = $orderRow['last_order_id'];

        // Get the cart items
        $cartQuery = "SELECT book_id, quantity FROM cart";
        $cartResult = $conn->query($cartQuery);

        // Insert the order items into the order_items table
        while ($row = $cartResult->fetch_assoc()) {
            $bookId = $row['book_id'];
            $quantity = $row['quantity'];

            $insertOrderItemQuery = "INSERT INTO order_items (order_id, book_id, quantity) VALUES ('$orderId', '$bookId', '$quantity')";
            $conn->query($insertOrderItemQuery);
        }

        // Clear the cart by deleting all items
        $deleteCartQuery = "DELETE FROM cart";
        $conn->query($deleteCartQuery);

        // Close the database connection
        $conn->close();
        ?>
        <div class="container">
        <div class="alert alert-success" role="alert">
            Order placed successfully. Order ID: <?php echo $orderId; ?>
        </div>
        <p>Thank you, <?php echo $name; ?>, for your order! You will receive an email confirmation shortly.</p>
            <a href="books.php" class="btn btn-primary">Continue Shopping</a>
        </div>

        <?php
    } else {
        ?>
        <div class="alert alert-danger" role="alert">
            Error placing order: <?php echo $conn->error; ?>
        </div>
        
        <?php
    }

} else {
    ?>
    <div class="alert alert-danger" role="alert">
        Invalid request!
    </div>
    <?php
}
?>
