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
  <title>Settings</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="../style.css" rel="stylesheet">
</head>

<body class="<?php echo $userTheme; ?>">
    <div class ="header-container">
        <h1>Settings</h1>
        <nav class="nav-bar">
            <a href="home.php">Home</a>
            <a href="fin.php">Income/Expenses</a>
            <a href="stockview.php">Live Stock View</a>
            <a href ="settings.php" class = "current-page">Settings</a>
        </nav>
    </div>

<div class = "creation-page">
  <div class = "settings-container">
    <p id ="settings-header"><?php echo $name ?>'s Settings</p>
    <div class = "settings-card">
      <img src = "../images/arrow.png" class = "settings-icon">
      <span>
          <select id = "themeSelector">
            <option value = "light-mode">Light Mode</option>
            <option value = "dark-mode">Dark Mode</option>
            <option value = "blue-mode">Blue Mode</option>
        </select>
      </span>

    </div>

  <a href="../account_managment/logout.php" class = "settings-card">
    <img src = "../images/arrow.png" class = "settings-icon"><span>Log out</span>
  </a>

  <a href="register.html" class = "settings-card">
    <img src = "../images/arrow.png" class = "settings-icon"><span>Delete account</span>
</a>
</div>
</div>
  <script src="../script.js"></script>
</body>

</html>