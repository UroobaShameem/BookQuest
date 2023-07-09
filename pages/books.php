<?php 
$pageTitle = "Shop";
include 'header.php'; ?>

<div class="container mt-4">
  <h2>Book Cards</h2>

  <?php
  include_once 'config.php';

  // Query to fetch unique categories
  $categoryQuery = "SELECT DISTINCT category FROM books";
  $categoryResult = mysqli_query($conn, $categoryQuery);

  // Loop through categories and display books for each category
  while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
    $category = $categoryRow['category'];

    // Query to fetch books for a specific category
    $query = "SELECT * FROM books WHERE category = '$category'";
    $result = mysqli_query($conn, $query);

    // Display category heading
    echo '<h4 class="mt-4">' . $category . '</h4>';
    echo '<div class="row">';

    // Check if any books found for the category
    if (mysqli_num_rows($result) > 0) {
      // Loop through the rows and display book cards
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="col-sm-6 col-md-4 col-lg-4">';
        echo '<div class="card mb-3">';
        echo '<div class="img-container">';
        echo '<img src="' . $row['img'] . '" class="card-img-top" alt="Book Image">';
        echo '</div>';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['title'] . '</h5>';
        echo '<p class="card-subtitle mb-2 text-muted">' . $row['book_id'] . '</p>';
        echo '<h6 class="card-subtitle mb-2 text-muted">' . $row['author'] . '</h6>';
        echo '<p class="card-text">Price: $' . $row['price'] . '</p>';
        echo '<form method="POST" action="add_to_cart.php">';
        echo '<input type="hidden" name="book_id" value="' . $row['book_id'] . '">';
        echo '<button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<p>No books found in this category.</p>';
    }

    echo '</div>';
  }

  // Close the database connection
  mysqli_close($conn);
  ?>

</div>

<?php include 'footer.php'; ?>
