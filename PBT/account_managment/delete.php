<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
    die("Unauthorized action.");
}
    $conn = new mysqli("localhost", "root", "", "pbtusers");

    if($conn->connect_error) {
        echo "Connection failed to db" . $conn->connect_error;
    }

    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()) {
        session_destroy();
        echo "User record deleted <a href = 'register.html'>Create new account</a>";
    }   
    else {
        echo "Failed to delete record" . $stmt->error;
    }



?>