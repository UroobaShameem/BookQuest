<?php
$pageTitle = "Home";
include 'header.php';

?>

<style>
body {
    font-family: Georgia, 'Times New Roman', Times, serif ; }
h2 {
    color: #15507a; }
.card {  
  background-color: #ffffff;
  transition: background-color 0.3s ease;
}

.card:hover {
  background-color: #2a90b6;
  color: #fff;
}
.button a {
    background-color: #15507a;
    color: #fff;
}
.button a:hover {
    background-color: #fff;
    color: #15507a;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease-in-out;
}

</style>

  <div class="container-fluid mb-2">
  <div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="asset/images/pictures/home1.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="asset/images/pictures/home2.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="asset/images/pictures/home3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>

<div class="container">
<h2 class="text-center">CATEGORIES</h2>

<div class="row mb-3">
    <div class="col-md-6 col-lg-4 g-5">
        <div class="card mb-3">
            <img src="asset/images/pictures/cat1.jpg" class="card-img-top" alt="Category 1">
            <div class="card-body">
                <h4 class="card-title text-center">Mystery</h4>
                <div class="text-center button">
                    <a href="books.php" class="btn btn-primary">View Books</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 g-5">
        <div class="card mb-3">
            <img src="asset/images/pictures/cat2.jpeg" class="card-img-top" alt="Category 2">
            <div class="card-body">
                <h4 class="card-title text-center">Young Adult</h4>
                <div class="text-center button">
                    <a href="books.php" class="btn btn-primary">View Books</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 g-5">
        <div class="card mb-3">
            <img src="asset/images/pictures/cat3.jpeg" class="card-img-top" alt="Category 3">
            <div class="card-body">
                <h4 class="card-title text-center">Fiction</h4>
                <div class="text-center button">
                    <a href="books.php" class="btn btn-primary">View Books</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
  

</div>
<?php include 'footer.php'; ?>

