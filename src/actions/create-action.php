<?php
session_start();
include "../config/settings.php";
$conn = new mysqli($servername, $mysql_user, $mysql_password, $mysql_database);

$task = $_POST['task'];
$date = $_POST['date'];
$userid = $_SESSION['id'];

$stmt = $conn->prepare("INSERT INTO items (user_id, text, date) VALUES(?, ?, ?)");
$stmt->bind_param ("iss", $userid, $task, $date);
$stmt->execute();
$stmt->close();

header("Location:../index.php");

$conn->close();
    
?>