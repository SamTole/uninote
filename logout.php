<?php

  require 'config.php';

  session_set_cookie_params(0, "$path", "web.njit.edu");
  session_start();

  $sid = session_id();

  $_SESSION = array();
  session_destroy();
  setcookie("PHPSESSID", "", time()-3600, $path, "", 0, 0);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>UniNote | Logout</title>
</head>

<body>
  <header class="hero">
    <div class="logo">
      <h1>
        <i class="fas fa-book-open"></i>
        UniNote
      </h1>
    </div>
    <div class="content-ctr">
      <div class="content-all">
        <h4>Initial session ID: <?php echo $sid; ?></h4>
        <h1>Logout Successful</h1>
        <h2>You have been signed out. Thank you for using UniNote!</h2>
        <a href="index.html">Back To Login</a>
      </div>
    </div>
  </header>
</body>

</html>