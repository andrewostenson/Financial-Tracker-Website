<?php 
include 'load_theme.php';
if (!isset($_SESSION['username'])) { //Makes sure username is set
    header("Location: index.html");
    exit();
}

$name = $_SESSION['username']; //Store username from session
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Account</title>
    <link href="style.css" rel="stylesheet">
</head>
<body class="<?php echo $userTheme; ?>">
    <h1 class="page-header">Account Information</h1>
    <nav class="nav-bar">
        <a href="home.php">Home</a>
        <a href="fin.php">Income/Expenses</a>
        <a href ="settings.php">Settings</a>
        <a href="account.php">Account</a>
    </nav>
    <a href="login.html">Log out</a>
    <a href="register.html">Delete account</a>
  <script src="script.js"></script>
</body>
</html>