<?php
include '../config/config.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

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
            $response['success'] = true;
            $response['message'] = 'Logging you in...';
        }
        else {
            $response['message'] = "Incorrect password";
        }
    }

    else {
        $response['message'] = "No account under given username";
    }
    $stmt->close();
}
$conn->close();
echo json_encode($response);
?>