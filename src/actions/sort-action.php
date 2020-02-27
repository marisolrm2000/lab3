<?php
session_start();
include "../config/settings.php";
$conn = new mysqli($servername, $mysql_user, $mysql_password, $mysql_database);

if($_SESSION['sort'] == 1){
    $_SESSION['sort'] = 0;
}

else{
    $_SESSION['sort'] = 1;
}

header("Location:../index.php");
    $conn->close();
    
?>