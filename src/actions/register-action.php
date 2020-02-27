<?php
    session_start();
    include "../config/settings.php";
    $conn = new mysqli($servername, $mysql_user, $mysql_password, $mysql_database);

    $_SESSION['sort'] = 0;
    $username = $_POST['username'];
    $userpass = hash("sha256",$_POST['userpass']);
    $passconf = hash("sha256",$_POST['passconf']);

    if ($passconf != $userpass){
        $_SESSION['error'] = "passwords do not match, loser.";
        header("Location:../register.php");
    }

    else{
        if ($stmt = $conn->prepare("SELECT username FROM users WHERE username = ?")) {
            $stmt->bind_param("s",$username);
            $stmt->execute();
            $stmt->store_result();
            $result = $stmt->num_rows;
            $stmt->close();
            if($result > 0){
                $_SESSION['error'] = "dumb dumb, that name is already taken";
                header("Location:../register.php");
            }
            else{
                $stmt = $conn->prepare("INSERT INTO users (username,password) VALUES(?,?)");
                $stmt->bind_param("ss",$username,$userpass);
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

                $_SESSION['loggedin'] = 1;
                $_SESSION['name'] = $username;

                $stmt = $conn->prepare("UPDATE users SET logged_in =? WHERE username = ?");
                $stmt->bind_param('is', $_SESSION['loggedin'], $username);
                $stmt->execute();
                $stmt->close();

                header("Location:../index.php");
            }
        } 
        else {
            echo "Error: $conn->error";
        }
        

    }

    $conn->close();

?>