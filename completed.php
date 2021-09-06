<?php

  session_start();

  require "db.php";

  try
  {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection = "";
  }

  catch(PDOException $e)
  {
    $connection = "Database Error :(";
  }

  $fname = $_SESSION["fname"];
  $lname = $_SESSION["lname"];
  $email = $_SESSION["email"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="css/tasks-style.css">
  <title>UniNote | Completed</title>
</head>

<body>
  <nav id="navbar">
    <div class="container">
      <h1>
        <i class="fas fa-book-open"></i>
        UniNote
      </h1>
      <ul>
        <li><a href="todos.php">To-Do</a></li>
        <li><a class="current" href="completed.php">Completed</a></li>
      </ul>
    </div>
  </nav>

  <header id="showcase">
    <div class="container">
      <div class="showcase-container">
        <div class="showcase-content">
          <h4><?php echo $connection; ?></h4>
          <h1>Welcome,
            <?php echo $fname . ' ' . $lname ?>!
          </h1>
          <h2>Below are your completed tasks.</h2>
          <a href="logout.php">Click To Logout</a>
        </div>
      </div>
    </div>
  </header>

  <p><?php 
  $results = "SELECT * from completed where email = '$email' ORDER BY duedate DESC";
  $statement = $conn->prepare($results);
  $statement->execute();
  $count = $statement->rowCount();
  if($count > 0){
    echo "<table border=\"1\"></th><th>id</th><th>duedate</th><th>title</th><th>description</th></tr>";
    foreach ($statement as $row) {
      echo "<tr>
              <td>".$row["id"]."</td>
              <td>".$row["duedate"]."</td>
              <td>".$row["title"]."</td>
              <td>".$row["description"]."</td>
            </tr>";}
  }else{
    echo '0 results';
  }
  ?></p>

</body>


</html>

