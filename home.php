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
    <title>Home</title>
    <link href="style.css" rel="stylesheet">
</head>
<body class="<?php echo $userTheme; ?>">
    <h1 class = "page-header"><?php echo $name ?>'s Dashboard</h1>
    <nav class="nav-bar">
        <a href="home.php">Home</a>
        <a href="fin.php">Income/Expenses</a>
        <a href ="settings.php">Settings</a>
        <a href="account.php">Account</a>
    </nav>
    <p>This is your personal online budget tracker! Here you can track your income, expenses, and accounts.</p>
    <h2>Financial Overview</h2>
    <p>[PREVIOUS WEEK INCOME]</p><br>
    <p>[PREVIOUS WEEK EXPENSE]</p><br>
    <p>[NET ACCOUNT BALANCE]</p><br>
    <p>[DATE/TIME OF LAST ACCOUNT UPDATE]</p><br>

    <a href="view_user.php">View All Users</a>
    <a href="register.html">Register Another User</a><br>
    <p>To-do: logout.php, dynamic income table, unique username validation</p>
  <script src="script.js"></script>
</body>
</html>
