<?php
include '../config/config.php';

$name = $_POST['name']; //Get user information
$email = $_POST['email'];
$age = $_POST['age'];
$password = $_POST['password'];

// --- CHECK IF USERNAME ALREADY EXISTS ---
$stmt = $conn->prepare("SELECT id FROM users WHERE name = ?");
$stmt->bind_param("s", $name);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {  
    // Username already exists
    die("Username already taken. Please go back and choose a new one.");
}
$stmt->close();

$hashedPassword = password_hash($password, PASSWORD_DEFAULT); //Hash password

$stmt = $conn->prepare("INSERT INTO users(name, email, age, password) VALUES(?, ?, ?, ?)"); //Insert user information

$stmt->bind_param("ssis", $name, $email, $age, $hashedPassword); //Bind info to appropriate types

if($stmt->execute()) { //Store username in session
    $_SESSION['username'] = $name;

    header("Location: /PBT/protected_pages/home.php");
    exit();
}
else {
    echo "Failed to save record" . $stmt->error;
}

$stmt->close();
$conn->close();
?>