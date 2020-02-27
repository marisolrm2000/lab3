<?php 
    session_start();
    if($_SESSION['loggedin'] == 0){ //if login in session is not set
      header("Location:login.php");
  }
?>
<!DOCTYPE html>
<html> 
    <head>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <link rel="stylesheet" href="style.css">
    </head>
    <body onload="readItems()">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
      <nav>
        <div class="nav-wrapper">
          <a href="#" class="brand-logo">To Do List</a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><form action = "actions/logout-action.php" method = "POST" ><button type="submit">Logout</button></form></li>
          </ul>
        </div>
      </nav>
      <div id="container">
      <ul id = "todo" class="collection">
        <?php 
          session_start();
          include "config/settings.php";
          $conn = new mysqli($servername, $mysql_user, $mysql_password, $mysql_database);
          
          if($_SESSION['sort']== 1){
            $stmt=$conn->prepare("SELECT * FROM items WHERE user_id = ?");
          }
          else{
            $stmt=$conn->prepare("SELECT * FROM items WHERE user_id = ? ORDER BY date ASC");
          }
          
          $stmt->bind_param("i", $_SESSION['id']);
          $stmt->execute();

          $result=$stmt->get_result();
          $stmt->close();

          while($row=$result->fetch_assoc()){
            echo readItems($row['id'], $row['text'], $row['date'], $row['done']);
          }

          function readItems($id, $task, $date, $done){
            $ischecked = "";
            if ($done == "1"){
              $ischecked = "checked";
            }
            
            $tasks = "<li class='collection-item'>
              <form class = 'fixme' action = 'actions/update-action.php' method='POST'>
                <input type = 'hidden' name='fred' value = '$id'/>
                <button type = 'submit' name='john'/>
                <label>
                  <input type = 'checkbox' $ischecked/>
                  <span>$task $date</span>
                </label>
              </form>
              <form class = 'fixme' action='actions/delete-action.php' method='POST'>
                <button id = 'removeItem' type='submit'>Delete</button>
                <input type='hidden' name='kate' value='$id'>
              </form>
            </li>";

            return $tasks;

          }
        ?>
      </ul>
        <form action="actions/create-action.php" method="POST">
          <input name="task" id="input" type="textbox" oninput="SavedStateInput" placeholder="Type a ToDo Item" required>
          <input name="date" id="dueDate" type="date" oninput="SavedStateDate" required>
          <button type="submit" id= "addItem" class="waves-effect waves-light btn">Add Item</button>
        </form>

        <form action="actions/sort-action.php" method = "post">
        <button id= "sortButton" onclick= "SortDate()" class="waves-effect waves-light btn"> Sort </button>
        </form>
      </div>
    <script src="js/script.js"></script>
    <?php 
      if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
      }
    ?>
    </body>
</html>
<?php
    unset($_SESSION['error']);
?>