<?php
$pageTitle = "Checkout";
include 'header.php';
?>

<div class="container mt-3">
    <h1 class="text-center ">Checkout</h1>

    <?php
    // database connection
    include 'config.php';

    // Get the cart items
    // Inner join to get the book details from the books table
    $cartQuery = "SELECT c.cart_id, b.book_id, b.title, b.price, c.quantity
                  FROM cart c
                  INNER JOIN books b ON c.book_id = b.book_id";
    $cartResult = $conn->query($cartQuery);

    // Check if the cart is empty
    if ($cartResult->num_rows > 0) {
        $total = 0;
        
        ?>

        <h2>Cart Items</h2>
        <table class="table">
            <thead>
                <tr class="fs-3" >
                    <th>Book</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
                <?php
                while ($row = $cartResult->fetch_assoc()) {
                    $subtotal = $row['price'] * $row['quantity']; // price x quantity for each book
                    $total += $subtotal;
                    ?>
                    <tr>
                        <td class="fs-5"><?php echo $row['title']; ?></td>
                        <td class="fs-5">$<?php echo $row['price']; ?></td>
                        <td class="fs-5"><?php echo $row['quantity']; ?></td>
                        <td class="fs-5">$<?php echo $subtotal; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <div class="text-end">
            <h4>Total: $<?php echo $total; ?></h4>
        </div>

        <h2 class="text-center pt-2">Customer Details</h2>
        <div class="container">
        <form action="place_order.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label fs-5">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fs-5">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label fs-5">Address</label>
                <textarea class="form-control" id="address" name="address" required></textarea>
            </div>
            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-primary fs-5">Place Order</button>
            </div>
        </form>
        </div>

        <?php
    } else {
        echo "<p>No items in the cart.</p>";
    }

    $conn->close();
    ?>
</div>

<?php include 'footer.php'; ?>
