<?php 
$pageTitle = "Add Book";
include 'header_admin.php'; ?>

<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve book details from the form
  $title = $_POST['title'];
  $book_id = $_POST['book_id'];
  $author = $_POST['author'];
  $category = $_POST['category'];
  $price = $_POST['price'];

  // Sanitize input data to prevent SQL injection
  $title = mysqli_real_escape_string($conn, $title);
  $book_id = mysqli_real_escape_string($conn, $book_id);
  $author = mysqli_real_escape_string($conn, $author);
  $category = mysqli_real_escape_string($conn, $category);
  $price = floatval($price);

    // Upload the book image to the uploads folder
  $imagePath = '';
  if ($_FILES['img']['size'] > 0) {
    $targetDirectory = 'asset/images/books/';
    $targetFile = $targetDirectory . basename($_FILES['img']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the uploaded file is an image
    $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($imageFileType, $validExtensions)) {
      // Move the uploaded file to the target directory
      if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFile)) {
        $imagePath = $targetFile;
      }
    }
  }

  // Insert the book details into the database table
  $query = "INSERT INTO books (title, book_id, author, category, price, img) 
            VALUES ('$title', '$book_id', '$author', '$category', $price, '$imagePath')";
  mysqli_query($conn, $query);

  // Redirect to a success page or refresh the current page
  header("Location: books.php");
  exit();
}

// Close the database connection
mysqli_close($conn);
?>

<div class="container mt-4 mb-4">
  <h2>Add Book</h2>
  <form action="add_book.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
      <label for="book_id">Book ID:</label>
      <input type="text" class="form-control" id="book_id" name="book_id" required>
    </div>
    <div class="form-group">
      <label for="author">Author:</label>
      <input type="text" class="form-control" id="author" name="author" required>
    </div>
    <div class="form-group">
      <label for="category">Category:</label>
      <input type="text" class="form-control" id="category" name="category" required>
    </div>
    <div class="form-group">
      <label for="price">Price:</label>
      <input type="number" step="0.01" class="form-control" id="price" name="price" required>
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control-file" id="img" name="img">
    </div>
    <button type="submit" class="btn btn-primary mt-2">Add Book</button>
  </form>
</div>

<?php include 'footer.php'; ?>