<?php
error_reporting(-1);
session_start();
echo "Something";
include "../config/settings.php";
$conn = new mysqli($servername, $mysql_user, $mysql_password, $mysql_database);
$_SESSION["error"] = "No error";


// if (isset($_POST['logout'])){
if ($stmt = $conn->prepare("UPDATE users SET logged_in = 0 WHERE username = ?")) {
    echo "executing";
    echo $_SESSION['name'];
    $stmt->bind_param('s', $_SESSION['name']);
    $stmt->execute();
    $stmt->close();

    session_unset();
    session_destroy();
    $_SESSION["error"] = "executed!?";

} else {
    echo "errored: $conn->error";
    $_SESSION["error"] = "ERROR: $conn->error";
}
// }
$conn->close();
// $_SESSION["error"] = "executed!?";
    echo "after";
header("Location:../login.php");
?>