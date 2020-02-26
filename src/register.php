<?php 
    session_start();
?>
<!DOCTYPE html>
<html> 
    <head>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <link rel="stylessheet" href="style.css">
    </head>
    <body>
        <?php 
            if(isset($_SESSION['error'])){
                echo $_SESSION['error'];
            }
        ?>
        <form action = "actions/register-action.php" method = "POST" >
            <div class="container">
                <input type="textbox" name="username" required>
                <input type="password" name="userpass" required>
                <input type="password" name="passconf" required>
                <input class="button" type="submit" name="buttn">
            </div>
        </form>
    </body>
</html>

<?php
    unset($_SESSION['error']);
?>