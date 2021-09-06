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

  $deleteid = $_GET['deleteid'];

  $query = "DELETE FROM todos WHERE id = '$deleteid'";
  $statement = $conn->prepare($query);
  $statement->execute();

  header("refresh:0, url=todos.php");

?>