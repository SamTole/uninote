<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>UniNote | Signup</title>
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
        <h1 id="signup"></h1>
        <h2 id="message">Thank you for registering for UniNote!</h2>
        <a href="index.html">Back To Login</a>
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
    document.getElementById("signup").innerHTML = "Signup Error :(";
    </script>';
    echo '<script>
    document.getElementById("message").innerHTML = "Failed to connect to database.";
    </script>';
  }

  $email = $_POST['email'];
  $password = $_POST['password'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $college = $_POST['college'];
  $major = $_POST['major'];

  $query = "INSERT INTO userdata(email, password, fname, lname, college, major) VALUES('$email', '$password', '$fname', '$lname', '$college', '$major')";
  $statement = $conn->prepare($query);
  $statement->execute();
  echo '<script>
  document.getElementById("signup").innerHTML = "Signup Complete";
  </script>';

?>