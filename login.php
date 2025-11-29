<?php
session_start();

//Connect block
$conn = new mysqli("localhost", "root", "", "pbtusers");

if($conn->connect_error) {
    echo "Connection failed to db" . $conn->connect_error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Ensure form was sent with post
    $name = $_POST['name']; //Get username nad password
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT name, password FROM users WHERE name = ?"); //Find in database
    $stmt->bind_param("s", $name); //Bind to s
    $stmt->execute();

    $result = $stmt->get_result(); //Store result

    if($result->num_rows === 1) { //Ensure only one row in database matches username
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) { //Verify password and username
            $_SESSION['username'] = $user['name'];
            header('Location: home.php');
            exit();
        }
        else {
            echo "Incorrect password";
        }
    }

    else {
        echo "No account under given username";
    }
    $stmt->close();
}
$conn->close();
?>