<?php
$pageTitle = "Cart";
include 'header.php';
?>

<style>
    body {
    font-family: Georgia, 'Times New Roman', Times, serif ;
    display: flex;
    flex-direction: column;
    min-height: 100vh; }
    h1 {
    color: #15507a;
    font-weight:bold ; }
    th {
    color: #15507a;
    font-size: 1.4rem;}
    td {
    font-size: 1.2rem;}
    h5 {
    color: #15507a;
    font-size: 1.6rem;
    font-weight: bold;}
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
    .wrapper {
    flex: 1;}

</style>

<div class="container">
    <div class="wrapper">
    <h1 class="text-center my-2">CART</h1>
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
                            <input type="number" class="form-control" min="1" value="<?php echo $row['quantity']; ?>" onchange="updateQuantity('<?php echo $row['cart_id']; ?>', this.value);">
                        </td>
                        <td id="subtotal-<?php echo $row['cart_id']; ?>">$<?php echo $subtotal; ?></td>
                        <td>
                            <button class="btn btn-danger" onclick="deleteItem('<?php echo $row['cart_id']; ?>');">Delete</button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <div class="text-end button">
            <h5 >Total: $<?php echo $total; ?></h5>
            <a href="checkout.php" class="btn btn-primary my-4">Checkout</a>
        </div>
        <?php
    } else {
        echo "<p>No items in the cart.</p>";
    }

    $conn->close();
    ?>

    <script>
        function updateQuantity(cartId, quantity) {
            // Send an AJAX request to update the quantity in the cart
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Update the UI if the quantity is updated successfully
                    // You can add any additional logic here, if needed
                    console.log("Quantity updated successfully.");
                    // Reload the page to reflect the updated cart
                    location.reload();
                }
            };
            xhttp.open("POST", "update_quantity.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("cart_id=" + cartId + "&quantity=" + quantity);
        }

        function deleteItem(cartId) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("Item deleted successfully.");
                    location.reload();
                }
            };
            xhttp.open("POST", "delete_item.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("cart_id=" + cartId);
        }
    </script>
    </div>
</div>
<?php include 'footer.php'; ?>
