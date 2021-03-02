<?php session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] != 0 ) {
die("You can not access !");
}
?>

<!-- <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">CedCab</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="dashboard.php">Home</a></li>
      <li><a href="user.php">Book a Ride</a></li>
      <li><a href="update.php">Update Account</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav> -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid ">
    
    <button class="btn btn-outline-success me-2" type="button" id="farebutton"><a id="fare" href="#">CedFare</a></button>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="./dashboard.php">Home</a>
        <a class="nav-link" href="./user.php">Book a Ride</a>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Account
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="update.php">Update Account</a></li>
            <li><a class="dropdown-item" href="signUp.php">Sign Up</a></li>
          </ul>
        </li>
        <a class="nav-link" href="./logout.php">Log Out</a>
      </div>
    </div>
  </div>
</nav>
