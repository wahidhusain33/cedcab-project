<?php

// session_start();
// if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] != 0 ) {
// die("You can not access !");
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="assets/cedcab.js"></script>
</head>
<body>
    <?php include_once "layout/header.php" ?>

      <div class="login">

      <div>
        <h1>Login Page !</h1>
        <form action="" method="POST" id="loginform">
              <div class="input-group flex-nowrap mb-3">
                <span class="input-group-text" id="addon-wrapping">Email Id</span>
                <input type="email" id="uname" class="form-control" placeholder="@ : " aria-label="Username" aria-describedby="addon-wrapping" name="uname" required>
            </div>
            <div class="input-group flex-nowrap mb-3">
                <span class="input-group-text" id="addon-wrapping">Password</span>
                <input type="password" id="pass" class="form-control" placeholder="Enter Password : " aria-label="Username" aria-describedby="addon-wrapping" name="pass" required>
            </div>
            <button type="submit" id="sub" class="btn btn-success btnC" name="sub">Login</button>
        </form>
        <p class="mt-3">New User ? <a href="signUp.php">SignUp</a></p>

        </div>
      </div>
    <?php include_once "layout/footer.php" ?>
</body>

</html>