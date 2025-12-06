<?php
include '../config/config.php';

$id = $_POST['id'];
$username = $_SESSION['username'];

// Delete only if the row belongs to the current user
$sql = "DELETE FROM finances WHERE id = ? AND username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id, $username);
$stmt->execute();

echo json_encode(['success' => true]);
?>
