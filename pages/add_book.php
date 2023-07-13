<?php 
$pageTitle = "Add Book";
include 'header_admin.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //book details from form
  $title = $_POST['title'];
  $book_id = $_POST['book_id'];
  $author = $_POST['author'];
  $category = $_POST['category'];
  $price = $_POST['price'];

  //check input for special characters
  $title = mysqli_real_escape_string($conn, $title);
  $book_id = mysqli_real_escape_string($conn, $book_id);
  $author = mysqli_real_escape_string($conn, $author);
  $category = mysqli_real_escape_string($conn, $category);
  $price = floatval($price);

  //getting image file
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

  // Redirect to books_admin.php
  header("Location: books_admin.php");
  exit();
}

// Close the database connection
mysqli_close($conn);
?>

<style>
body{
font-family: Georgia, 'Times New Roman', Times, serif ;
font-size: 1.2rem;}
h1 {
color: #15507a;
font-weight:bold ; }
.button button {
    background-color: #15507a;
    color: #fff;
    font-size: 1.4rem;}
.button button:hover {
    background-color: #fff;
    color: #15507a;
    font-size: 1.6rem;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease-in-out;}
</style>

<div class="container mt-4 mb-4">
  <h1 class="text-center">Add Book</h1>
  
  <form action="add_book.php" method="POST" enctype="multipart/form-data">
    <div class="form-group mb-2">
      <label for="title">Title:</label>
      <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group mb-2">
      <label for="book_id">Book ID:</label>
      <input type="text" class="form-control" id="book_id" name="book_id" required>
    </div>
    <div class="form-group mb-2">
      <label for="author">Author:</label>
      <input type="text" class="form-control" id="author" name="author" required>
    </div>
    <div class="form-group mb-2">
      <label for="category">Category:</label>
      <input type="text" class="form-control" id="category" name="category" required>
    </div>
    <div class="form-group mb-2">
      <label for="price">Price:</label>
      <input type="number" step="0.01" class="form-control" id="price" name="price" required>
    </div>
    <div class="form-group mb-2">
        <label for="image">Image:</label>
        <input type="file" class="form-control-file" id="img" name="img">
    </div>
    <div class="button my-3 text-center">
    <button type="submit" class="btn btn-primary mt-2">Add Book</button>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
