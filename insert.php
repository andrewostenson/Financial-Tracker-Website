<?php
session_start();

//Connect block
$conn = new mysqli("localhost", "root", "", "pbtusers");

if($conn->connect_error) {
    echo "Connection failed to db" . $conn->connect_error;
}

$name = $_POST['name']; //Get user information
$email = $_POST['email'];
$age = $_POST['age'];
$password = $_POST['password'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT); //Hash password

$stmt = $conn->prepare("INSERT INTO users(name, email, age, password) VALUES(?, ?, ?, ?)"); //Insert user information

$stmt->bind_param("ssis", $name, $email, $age, $hashedPassword); //Bind info to appropriate types

if($stmt->execute()) { //Store username in session
    $_SESSION['username'] = $name;

    header("Location: home.php");
    exit();
}
else {
    echo "Failed to save record" . $stmt->error;
}

$stmt->close();
$conn->close();
?>