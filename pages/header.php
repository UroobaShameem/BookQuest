<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="asset/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  

  <!--navbar start -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary pt-0 mt-0">
    <div class="container-fluid" id="navbar">
      <img src="asset/images/logo.png" alt="logo">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse nav-center" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="books.php">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="books.php">Contact</a>
          </li>

          <li class="nav-item nav-right">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa-solid fa-user-large"></i> Login</a>
          </li>
          <li class="nav-item nav-right">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#cartModal"><i class="fas fa-shopping-cart"></i> Cart</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login">Login</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup">Signup</button>
            </li>
          </ul>
        </div>
        <div class="modal-body">
          <div class="tab-content">
            <div id="login" class="tab-pane fade show active">
              <h3>Login</h3>
              <form method="POST" action="login.php">
                <div class="mb-3">
                  <label for="loginUsername" class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" placeholder="Enter your username">
                </div>
                <div class="mb-3">
                  <label for="loginPassword" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Enter your password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
              </form>
            </div>
            <div id="signup" class="tab-pane fade">
              <h3>Signup</h3>
              <form method="POST" action="signup.php">
                <div class="mb-3">
                  <label for="signupUsername" class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="mb-3">
                  <label for="signupEmail" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Enter your email">
                </div>
                <div class="mb-3">
                  <label for="signupPassword" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Choose a password">
                </div>
                <button type="submit" class="btn btn-primary">Signup</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Cart Modal -->
  <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cartModalLabel">Cart</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Cart content goes here -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Checkout</button>
        </div>
      </div>
    </div>
  </div>
  <!--navbar end -->
</body>
</html>