<?php
session_start();
$conn = new mysqli($servername, $mysql_user, $mysql_password, $mysql_database);
$_SESSION["error"] = "No error";


// if (isset($_POST['logout'])){
if ($stmt = $conn->prepare("UPDATE users SET logged_in = 0 WHERE username = ?")) {
    $stmt->bind_param('s', $_SESSION['name']);
    $stmt->execute();
    $stmt->close();

    session_unset();
    session_destroy();
    $_SESSION["error"] = "executed!?";
} 
else {
    $_SESSION["error"] = "ERROR: $conn->error";
}
// }
$conn->close();
header("Location:../login.php");
?>