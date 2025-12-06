<?php 
include '../config/load_theme.php'; 
include '../config/config.php';

if (!isset($_SESSION['username'])) { //Makes sure username is set
    header("Location: ../account_managment/login.html");
    exit();
}

$name = $_SESSION['username']; //Store username from session

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Live Stock View</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="../style.css" rel="stylesheet">
</head>

<body class="<?php echo $userTheme; ?>">
    <div class ="header-container">
        <h1>Live Stock View</h1>
        <nav class="nav-bar">
            <a href="home.php">Home</a>
            <a href="fin.php">Income/Expenses</a>
            <a href="stockview.php">Live Stock View</a>
            <a href ="settings.php">Settings</a>
            <a href = "help.php">Help</a>
        </nav>
    </div>

    <p>Here you can view live stock information</p>
    <canvas id="stockChart"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="stockapi.js"></script>
</body>
</html>