<?php
session_start();

//Connect block
$conn = new mysqli("localhost", "root", "", "pbtusers");

if($conn->connect_error) {
    echo "Connection failed to db" . $conn->connect_error;
}

if(isset($_SESSION['username']) && isset($_POST['theme'])){ //Check if user logged in
    $theme = $_POST['theme'];
    $username = $_SESSION['username'];

    $stmt = $conn->prepare("UPDATE users SET theme=? WHERE name=?"); //Update users theme connected to their username
    $stmt->bind_param("ss", $theme, $username);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>