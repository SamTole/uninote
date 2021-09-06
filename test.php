<!-- Shy's Edit -->

<?php

session_start();

  require "db.php";

  try
  {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo '<script>
    // document.getElementById("connection").innerHTML = "Successfully connected to database.";
    // </script>';
    
  }

  catch(PDOException $e)
  {
    // echo '<script>
    // document.getElementById("signup").innerHTML = "Signup Error :(";
    // </script>';
    // echo '<script>
    // document.getElementById("message").innerHTML = "Failed to connect to database.";
    // </script>';
  }

if(isset($_GET["duedate"]) && isset($_GET["title"]) && isset($_GET["description"]))
  {
    $duedate = $_GET["duedate"];
    $description = $_GET["description"];
    $title = $_GET["title"];
    $email = $_SESSION["email"];
    $query = "INSERT INTO todos(id, title, creation, duedate, description, email) VALUES(NULL, '$title', NOW(), '$duedate', '$description','$email')";
    $statement = $conn->prepare($query);
    $statement->execute();
  }

  header("refresh:0, url=todos.php");
?>