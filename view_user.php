<?php

//Connect block
$conn = new mysqli("localhost", "root", "", "pbtusers");

if($conn->connect_error) {
    echo "Connection failed to db" . $conn->connect_error;
}

$result = $conn->query("SELECT * FROM users");

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>View Users</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="style.css" rel="stylesheet">
</head>

<body>
    
    <h2>View Users</h2>
    <table border="1" cellpadding="8">
        <th>ID</th> <th>Name</th> <th>Email</th><th>Age</th>
        <?php
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['age']}</td>
                </tr>";
            }
        }
        else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        ?>
    </table>
    <a href=register.html>Add new entry</a>

</body>

</html>