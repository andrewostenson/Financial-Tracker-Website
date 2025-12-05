<?php
include '../config/config.php';

$username = $_SESSION['username'];
$title = $_POST['title'] ?? '';
$value = $_POST['value'] ?? '0';
$date = $_POST['date'] ?? '';

// Insert new row into finances table
$sql = "INSERT INTO finances (username, title, value, date) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssds", $username, $title, $value, $date);
$stmt->execute();

header("Location: ../protected_pages/fin.php");
exit();
?>
