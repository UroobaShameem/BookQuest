<?php

$pageTitle = "About Us";
include 'header.php';
?>

<style>
body {
    font-family: Georgia, 'Times New Roman', Times, serif ; }
    p {
    font-size: 1.3rem;
    text-align: center; }
    h1 {
    color: #15507a;
    text-decoration: underline;
    font-weight:bold ; }
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

</style>

<div class="container mt-4">
        <h1 class="text-center">ABOUT US</h1>
        <p class="text-center mt-3">Book Quest is an exceptional online bookstore that caters to book lovers of all genres and interests. 
            With a vast collection of books from renowned authors and publishers, Book Quest offers a seamless and immersive reading 
            experience to its customers. Our platform provides a user-friendly interface that allows users to effortlessly browse 
            through various categories, discover new releases, and explore timeless classics.
        <br>At Book Quest, we believe in the power of books to inspire, educate, and entertain.</p>
        
        <h2 class="text-center">FEATURES</h2>
        <div class="row">
            <div class="col-md-6 col-lg-4 g-5 mt-0">
                <div class="card mb-3 border-0">
                    <img src="asset/images/pictures/about1.jpg" class="card-img-top" alt="Feature 1">
                    <div class="card-body">
                        <h4 class="card-title text-center">Fast Delivery</h4>
                        <p class="card-text">We know how eager you are to start reading your newly 
                            found treasure thats why our providers to ensure fast delivery straight to your doorsteps in good condition.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 g-5 mt-0">
                <div class="card mb-3 border-0">
                    <img src="asset/images/pictures/about2.jpg" class="card-img-top" alt="Feature 2">
                    <div class="card-body">
                        <h4 class="card-title text-center">Best Quality</h4>
                        <p class="card-text">We understand the importance of receiving books in excellent condition. That's why we meticulously inspect every book before it reaches your hands.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 g-5 mt-0">
                <div class="card mb-3 border-0">
                    <img src="asset/images/pictures/about3.jpg" class="card-img-top" alt="Feature 3">
                    <div class="card-body">
                        <h4 class="card-title text-center">Customer Service</h4>
                        <p class="card-text">At BookQuest, we prioritize your satisfaction. Our dedicated customer service team is always ready to assist you with any inquiries or recommendations.</p>
                    </div>
                </div>
            </div>
        </div>

       
    </div>

  
<?php include 'footer.php'; ?>