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
  <title>UniNote | To-Dos</title>
  <style>
    #duedatediv,
    #titlediv,
    #descriptiondiv {
      display: none;
    }
  </style>
</head>

<body>
  <nav id="navbar">
    <div class="container">
      <h1>
        <i class="fas fa-book-open"></i>
        UniNote
      </h1>
      <ul>
        <li><a class="current" href="todos.php">To-Do</a></li>
        <li><a href="completed.php">Completed</a></li>
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
          <h2>Below are your incomplete tasks.</h2>
          <a href="logout.php">Click To Logout</a>
        </div>
      </div>
    </div>
  </header>

  <!-- Shy's Section -->

  <!-- Add -->

  <div class="tdlist">
    <br><br>
    <h1 id="title">To-Do Tasks</h1>
  <form action="test.php" method="get" id="addtask" >
    <label for="duedate">Due Date</label>
    <input type="datetime-local" name="duedate">
    <label for="title">Task Title</label>
    <input type="text" name="title">
    <label for="description">Task Description</label>
    <input type="text" name="description">
    <input type="submit" value="Add">
  </form>

  <!-- Edit -->

  <br>
  <form action="edit.php">
    <select name="choice" id="choice">
      <option value="duedate">Edit due date</option>
      <option value="title">Edit task name</option>
      <option value="description">Edit description</option>
    </select>
    <div id="editid">
      <input type="text" name="chgid" placeholder="Enter ID of task to edit">
    </div>
    <div id="duedatediv">
      <input type="datetime-local" name="chgdate" placeholder="Edit due date">
    </div>
    <div id="titlediv">
      <input type="text" name="chgtitle" placeholder="Edit task name">
    </div>
    <div id="descriptiondiv">
      <input type="text" name="chgdesc" placeholder="Edit description">
    </div>
    <input type="submit" value="Edit">
  </form>

  <script>
    var ptrMenu = document.getElementById("choice");
    ptrMenu.addEventListener("change", choose);

    var ptrDate = document.getElementById("duedatediv");
    var ptrTitle = document.getElementById("titlediv");
    var ptrDesc = document.getElementById("descriptiondiv");

    function choose() {
      if (this.value == "duedate") {
        ptrDate.style.display = "block";
        ptrTitle.style.display = "none";
        ptrDesc.style.display = "none";
      }
      if (this.value == "title") {
        ptrDate.style.display = "none";
        ptrTitle.style.display = "block";
        ptrDesc.style.display = "none";
      }
      if (this.value == "description") {
        ptrDate.style.display = "none";
        ptrTitle.style.display = "none";
        ptrDesc.style.display = "block";
      }
    }
  </script>  

  <!-- Delete -->

  <br>
  <form action="delete.php">
    <div id="deleteid">
      <input type="text" name="deleteid" placeholder="Enter ID of task to delete">
    </div>
    <input type="submit" value="Delete">
  </form>  

  <!-- Checked-off -->

  <br>
  <form action="checked.php">
    <div id="checkedid">
      <input type="text" name="checkedid" placeholder="Enter ID of completed task">
    </div>
    <input type="submit" value="Complete">
  </form>  

  <!-- Table Display -->

  <p><?php 
  $results = "SELECT * from todos where email = '$email' ORDER BY duedate DESC";
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
</div>

</html>

