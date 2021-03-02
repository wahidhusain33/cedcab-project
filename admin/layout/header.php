<?php
session_start();
if(!isset($_SESSION['admin']['admin_id']) || ($_SESSION['admin']['is_admin'])!=1){
  die('You cannot access');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">CedCab</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="admin_module.php">Home</a></li>
      <!-- <li><a href="../index.php">Check Fare</a></li> -->
      <li><a href="update.php">Update Account</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>

<!-- </nav> -->
</body>
</html>
