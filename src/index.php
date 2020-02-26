<?php 
    session_start();
    if(isset($_SESSION['loggedin'] != 1)){ //if login in session is not set
      header("Location:../login.php");
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
        <form onsubmit="createItem()">
          <ul id = "todo"></ul>
          <input id="input" type="textbox" oninput="SavedStateInput" placeholder="Type a ToDo Item" required>
          <input id="dueDate" type="date" oninput="SavedStateDate" required>
          <button type="submit" id= "addItem" class="waves-effect waves-light btn">Add Item</button>
        </form>
        <button id= "sortButton" onclick= "SortDate()" class="waves-effect waves-light btn"> Sort </button>
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