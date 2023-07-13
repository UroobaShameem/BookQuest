<?php

//function to generate order id
function generateOrderID() {
    $length = 8;
    $orderID = '';
  
    //generate a random string of numbers
    for ($i = 0; $i < $length; $i++) {
        $orderID .= mt_rand(0, 9);
    }
  
    return $orderID;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //retrieve data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

   //database connection
    include 'config.php';

    //get order id from function
    $orderId = generateOrderID();

    // Insert the order details into the orders table
    $insertOrderQuery = "INSERT INTO orders (name, email, address) VALUES ('$name', '$email', '$address')";
    if ($conn->query($insertOrderQuery) === TRUE) {
        //get the last order id 
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

    <style>
    body {
    font-family: Georgia, 'Times New Roman', Times, serif ; }
    h3 {
    color: #15507a;
    font-weight:bold ; }
    p {
    font-size: 1.2rem;}
    .button a {
    background-color: #15507a;
    color: #fff;
    font-size: 1.4rem;}
    .button a:hover {
    background-color: #fff;
    color: #15507a;
    font-size: 1.6rem;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease-in-out;}
    
    </style>

        <div class="container">
        <div class="alert alert-success" role="alert">
            <h3 class="text-center mx-4">Order placed successfully. Order ID: <?php echo $orderId; ?></h3>
        </div>
        <p class="text-center">Thank you, <?php echo $name; ?>, for your order! You will receive an email confirmation shortly.</p>
        <div class="text-center button">
            <a href="books.php" class="btn btn-primary">Continue Shopping</a>
        </div>
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
