<?php 
$pageTitle = "Books";
include 'header_admin.php'; ?>

<style>
  body {
    font-family: Georgia, 'Times New Roman', Times, serif ; }
    h1 {
    color: #15507a;
    font-weight:bold ; }
    h2 {
    color: #15507a;
    font-weight: bold;
    text-decoration: underline; }
    p {font-size: 1.2rem;}
    #card-height {
        display: flex;}
    #card-height .card{
        flex: 1;}
    .card-img-top {
        object-fit: cover;
        height: 500px;}
  </style>

<div class="container mt-4">
  <h1 class="text-center mb-4">BOOKS</h1>

  <?php
  include_once 'config.php';

  //fetch unique categories from the books table
  $categoryQuery = "SELECT DISTINCT category FROM books";
  $categoryResult = mysqli_query($conn, $categoryQuery);

  // Loop through categories and display books for each category
  while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
    $category = $categoryRow['category'];

    // Query to fetch books for a specific category
    $query = "SELECT * FROM books WHERE category = '$category'";
    $result = mysqli_query($conn, $query);

    //display category
    echo '<h2 class="mt-2 mb-3 text-center">' . $category . '</h2>';
    echo '<div class="row">';

    // Check if any books found for the category
    if (mysqli_num_rows($result) > 0) {
      //display books under category
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="col-sm-6 col-md-4 col-lg-4" id="card-height">';
        echo '<div class="card mb-4">';
        echo '<div class="img-container">';
        echo '<img src="' . $row['img'] . '" class="card-img-top" alt="Book Image">';
        echo '</div>';
        echo '<div class="card-body">';
        echo '<h4 class="card-title text-center">' . $row['title'] . '</h4>';
        echo '<h5 class="card-subtitle mb-2 text-muted">' . $row['author'] . '</h5>';
        echo '<p class="card-text">' . $row['book_id'] . '</p>';
        echo '<p class="card-text">Price: $' . $row['price'] . '</p>';
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
