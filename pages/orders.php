<?php
$pageTitle = "Orders";
include 'header_admin.php';
//database connection
include 'config.php';

// Fetch the order details
$orderQuery = "SELECT o.order_id, o.name, o.email, o.address, i.book_id, i.quantity, b.title
               FROM orders o
               INNER JOIN order_items i ON o.order_id = i.order_id
               INNER JOIN books b ON i.book_id = b.book_id";
$orderResult = $conn->query($orderQuery);
?>

<style>
body{
font-family: Georgia, 'Times New Roman', Times, serif ;
font-size: 1.2rem;}
h1 {
color: #15507a;
font-weight:bold ; }
h3, .card-title {
color: #15507a;
font-weight:bold ; }

</style>

    <div class="container mt-4">
        <h1 class="text-center">Order Details</h1>
        <?php
        // Check if any orders are found
        if ($orderResult->num_rows > 0) {
            // Loop through each order
            while ($row = $orderResult->fetch_assoc()) {
                // Display the order information
                echo '<div class="card mb-3">';
                echo '<div class="card-body">';
                echo '<h3 class="card-title">Order ID: ' . $row['order_id'] . '</h3>';
                echo '<p class="card-text">Name: ' . $row['name'] . '</p>';
                echo '<p class="card-text">Email: ' . $row['email'] . '</p>';
                echo '<p class="card-text">Address: ' . $row['address'] . '</p>';

                // Display the order items
                echo '<h3 class="mt-3">Order Items:</h3>';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<p class="card-text">Book: ' . $row['title'] . '</p>';
                echo '<p class="card-text">Quantity: ' . $row['quantity'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                    }
                } else {
                    echo '<p>No order items found for this order.</p>';
                }

        // Close the database connection
        $conn->close();
        ?>
    </div>

<?php include 'footer.php'; ?>
