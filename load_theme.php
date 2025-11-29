<?php
session_start();

// Default theme
$userTheme = "light-mode";

if (isset($_SESSION['username'])) { //Check if logged in
    $username = $_SESSION['username'];

    $conn = new mysqli("localhost", "root", "", "pbtusers");
    
    if($conn->connect_error) {
        echo "Connection failed to db" . $conn->connect_error;
    }


    $stmt = $conn->prepare("SELECT theme FROM users WHERE name = ?"); //Get theme and bind to username
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) { //Check for row associated with result
        $user = $result->fetch_assoc();
        if (!empty($user['theme'])) {
            $userTheme = $user['theme'];
        }
    }

    $stmt->close();
    $conn->close();
}
?>
