<?php
session_start();
include "../config/settings.php";
$conn = new mysqli($servername, $mysql_user, $mysql_password, $mysql_database);

$taskid = $_POST['kate'];
$stmt = $conn->prepare('DELETE FROM items WHERE id=?');
$stmt->bind_param('i',$taskid);
$stmt->execute();
$stmt->close();
header("Location:../index.php");

$conn->close();
    
?>