<?php
$pageTitle = "Dashboard";
include 'header_admin.php';
include 'config.php';

//fetch user details from database
$userQuery = "SELECT u.username, u.password, u.email
               FROM user u";
$Result = $conn->query($userQuery);
?>

<style>
    body {
    font-family: Georgia, 'Times New Roman', Times, serif ;
    display: flex;
    flex-direction: column;
    min-height: 100vh; }
    .wrapper {
    flex: 1;}
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
    h5 {
    color: #15507a;
    font-size: 1.6rem;
    font-weight: bold;}
    h1 {
    color: #15507a;
    font-weight:bold ; }
    p {
    font-size: 1.2rem;
    }
</style>

<div class="container">
<div class="wrapper">
<div class="row mt-3">
<h1 class="text-center mt-2 mb-3">DASHBOARD</h1>
  <div class="col-sm-6 mb-3 mb-sm-0">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-center">Add New Book</h5>
        <div class="text-center button">
        <a href="add_book.php" class="btn btn-primary">Add</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-center">View Orders</h5>
        <div class="text-center button">
        <a href="orders.php" class="btn btn-primary">View</a>
        </div>
      </div>
    </div>
  </div>

<div class="container mt-4 mb-3">
        <h5 class="text-center mb-2">Registered Users</h5>
        <?php
        //check if there are any users
        if ($Result->num_rows > 0) {
            //print user details
            while ($row = $Result->fetch_assoc()) {
                echo '<div class="card mb-3">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">Username: ' . $row['username'] . '</h5>';
                echo '<p class="card-text">Password: ' . $row['password'] . '</p>';
                echo '<p class="card-text">Email: ' . $row['email'] . '</p>';
              }
            } else {
                echo '<p>No users found.</p>';
            }

            // Close the database connection
        $conn->close();
        ?>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include 'footer.php'; ?>