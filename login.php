<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>UniNote | Login</title>
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
        <h4 id="connection"></h4>
        <h1 id="login"></h1>
        <h2 id="redirect"></h2>
        <a id="link" href="index.html">Back To Login</a>
      </div>
    </div>
  </header>
</body>

</html>

<?php

  session_start();

  require "db.php"; 

  try
  {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo '<script>
    document.getElementById("connection").innerHTML = "Successfully connected to database.";
    </script>';  
  }

  catch(PDOException $e)
  {
    echo '<script>
    document.getElementById("login").innerHTML = "Login Error :(";
    </script>';
    echo '<script>
    document.getElementById("redirect").innerHTML = "Failed to connect to database.";
    </script>';
  }

  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT fname, lname FROM userdata WHERE email = '$email' and password = '$password'";
  $statement = $conn->prepare($query);
  $statement->execute();
  $count = $statement->rowCount();

  if ($count > 0)
  {
    $_SESSION["email"] = $email;
    $results = $statement->fetch();
    $fname = $results[0];
    $lname = $results[1];
    $_SESSION["fname"] = $fname;
    $_SESSION["lname"] = $lname;
    echo '<script>
    document.getElementById("login").innerHTML = "Login Successful";
    </script>';
    echo '<script>
    document.getElementById("redirect").innerHTML = "Please wait. Logging you in...";
    </script>';
    echo '<script>
    document.getElementById("link").innerHTML = "";
    </script>';
    header("refresh:3; url=todos.php");
    exit();
  }
  else 
  {
    echo '<script>
    document.getElementById("login").innerHTML = "Login Failed";
    </script>';
    echo '<script>
    document.getElementById("redirect").innerHTML = "Invalid credentials. Redirecting to login page...";
    </script>';
    echo '<script>
    document.getElementById("link").innerHTML = "";
    </script>';
    header("refresh:3; url=index.html");
    exit();
  }

?>