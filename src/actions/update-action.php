<?php
    session_start();
    include "../config/settings.php";
    $conn = new mysqli($servername, $mysql_user, $mysql_password, $mysql_database);

    $taskid = $_POST['fred'];
    $stmt = $conn->prepare("SELECT done FROM items WHERE id =?");
    $stmt->bind_param("i", $taskid);
    $stmt->execute();

    $done=$stmt->store_result();
    $stmt->bind_result($done);
    $stmt->fetch();
    $stmt->close();

    if($done == 0){
        $done = 1;
    }

    else{
        $done = 0;
    }

    $stmt = $conn->prepare("UPDATE items SET done =? WHERE id =?");
    $stmt->bind_param("ii", $done, $taskid);
    $stmt->execute();
    $stmt->close();
    header("Location:../index.php");
    $conn->close();
?>