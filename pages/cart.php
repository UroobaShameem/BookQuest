<?php
$pageTitle = "Cart";
include 'header.php';
?>
    <div class="container">
        <h1>Cart</h1>
        <?php
        // Assuming you have a database connection
        include_once 'config.php';

        // Get the cart items
        $cartQuery = "SELECT c.cart_id, b.book_id, b.title, b.img, b.price, c.quantity
                      FROM cart c
                      INNER JOIN books b ON c.book_id = b.book_id";
        $cartResult = $conn->query($cartQuery);

        if ($cartResult->num_rows > 0) {
            $total = 0; // Variable to store the total amount
            ?>
            <form method="POST" action="">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Book</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $cartResult->fetch_assoc()) {
                            $subtotal = $row['price'] * $row['quantity'];
                            $total += $subtotal;
                            ?>
                            <tr>
                                <td><?php echo $row['title']; ?></td>
                                <td><img src="<?php echo $row['img']; ?>" alt="Book Image" style="width: 50px;"></td>
                                <td>$<?php echo $row['price']; ?></td>
                                <td>
                                    <input type="number" name="quantity[<?php echo $row['cart_id']; ?>]" class="form-control" min="1" value="<?php echo $row['quantity']; ?>">
                                </td>
                                <td>$<?php echo $subtotal; ?></td>
                                <td>
                                    <button type="submit" name="update" value="<?php echo $row['cart_id']; ?>" formaction="update_quantity.php" class="btn btn-primary">Update</button>
                                    <button type="submit" name="delete" value="<?php echo $row['cart_id']; ?>" formaction="delete_item.php" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="text-end">
                    <h5>Total: $<?php echo $total; ?></h5>
                </div>
            </form>
            <?php
        } else {
            echo "<p>No items in the cart.</p>";
        }

        if (isset($_POST['update'])) {
            $updateCartId = $_POST['update'];
            $newQuantity = $_POST['quantity'][$updateCartId];

            // Update the quantity in the cart table
            $updateQuery = "UPDATE cart SET quantity = $newQuantity WHERE cart_id = '$updateCartId'";
            if ($conn->query($updateQuery) === TRUE) {
                echo "<p>Quantity updated successfully!</p>";
            } else {
                echo "<p>Error updating quantity: " . $conn->error . "</p>";
            }
        }

        if (isset($_POST['delete'])) {
            $deleteCartId = $_POST['delete'];

            // Delete the item from the cart table
            $deleteQuery = "DELETE FROM cart WHERE cart_id = '$deleteCartId'";
            if ($conn->query($deleteQuery) === TRUE) {
                echo "<p>Item deleted successfully!</p>";
            } else {
                echo "<p>Error deleting item: " . $conn->error . "</p>";
            }
        }

        $conn->close();
        ?>

    </div>
<?php include 'footer.php'; ?>
