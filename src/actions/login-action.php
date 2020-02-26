<?php
    session_start();
    include "../config/settings.php";
    $conn = new mysqli($servername, $mysql_user, $mysql_password, $mysql_database);

    $username = $_POST['username'];
    $userpass = hash("sha256",$_POST['userpass']);
    
    if ($stmt = $conn->prepare("SELECT username FROM users WHERE username=? AND password=?")) {
        $stmt->bind_param("ss",$username, $userpass);
        $stmt->execute();
        $count = $stmt->get_result();
        $another = $count->num_rows;
        $stmt->store_result();
        $stmt->close();
        if($another == 0){
            $_SESSION['error'] = "wrong username or password";
            header("Location:../login.php");
        }
        else{
            $_SESSION['loggedin'] = 1;
            $_SESSION['name'] = $username;
            $stmt = $conn->prepare("UPDATE users SET logged_in =? WHERE username = ?");
            $stmt->bind_param('is', $_SESSION['loggedin'], $username);
            $stmt->execute();
            $stmt->close();

            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->bind_param("s",$username);
            $stmt->execute();
            $id = $stmt->store_result();
            $stmt->bind_result($id);
            $stmt->fetch();
            $stmt->close();
            $_SESSION['id'] = $id;

            header("Location:../index.php"); 
        }
    }
?>