<?php
include '../config/config.php';

if (!isset($_SESSION['username'])) {
    die("Unauthorized action.");
}

$name = $_SESSION['username'];

$stmt = $conn->prepare("DELETE FROM users WHERE name=?");
$stmt->bind_param("s", $name);

if($stmt->execute()) {
    session_destroy();
    header("Location: ../account_managment/register.html");
    exit();
}   

else {
    echo "Failed to delete record" . $stmt->error;
}
?>