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

  if(isset($_GET["checkedid"]))
  {
    $id = $_GET["checkedid"];
    $email = $_SESSION["email"];
    $query = "INSERT INTO completed
              SET id = '$id',
                  title = (SELECT title FROM todos WHERE id = '$id'),
                  creation = (SELECT creation FROM todos WHERE id = '$id'),
                  duedate = (SELECT duedate FROM todos WHERE id = '$id'),
                  description = (SELECT description FROM todos WHERE id = '$id'),
                  email = '$email'";
    $statement = $conn->prepare($query);
    $statement->execute();
  }

    // $query = "DELETE FROM todos WHERE id = '$id'";
    // $statement = $conn->prepare($query);
    // $statement->execute();

  header("refresh:0, url=todos.php");

?>