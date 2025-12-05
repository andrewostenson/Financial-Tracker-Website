<?php

//Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//Connect block
$conn = new mysqli("localhost", "root", "", "pbtusers");

if($conn->connect_error) {
    echo "Connection failed to db" . $conn->connect_error;
}


?>