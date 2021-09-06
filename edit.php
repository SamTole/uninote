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

  $choice = $_GET['choice'];
  $id = $_GET['chgid'];
  $duedate = $_GET['chgdate'];
  $title = $_GET['chgtitle'];
  $description = $_GET['chgdesc'];

  switch($choice)
  {
    case "duedate":
      $query = "UPDATE todos SET duedate = '$duedate' WHERE id = '$id'";
      $statement = $conn->prepare($query);
      $statement->execute();
      break;
    case "title":
      $query = "UPDATE todos SET title = '$title' WHERE id = '$id'";
      $statement = $conn->prepare($query);
      $statement->execute();
      break;
    case "description":
      $query = "UPDATE todos SET description = '$description' WHERE id = '$id'";
      $statement = $conn->prepare($query);
      $statement->execute();
      break;
  }

  header("refresh:0, url=todos.php");

?>