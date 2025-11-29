<?php include 'load_theme.php'; ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Settings</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="style.css" rel="stylesheet">
</head>

<body class="<?php echo $userTheme; ?>">
  <h1 class = "page-header">Settings Page</h1>

      <nav class="nav-bar">
        <a href="home.php">Home</a>
        <a href="fin.php">Income/Expenses</a>
        <a href ="settings.php">Settings</a>
        <a href="account.php">Account</a>
    </nav>

<div class = "creation-page">
  <div class = "creation-container">
  <select id = "themeSelector">
        <option value = "light-mode">Light Mode</option>
        <option value = "dark-mode">Dark Mode</option>
        <option value = "blue-mode">Blue Mode</option>
  </select>
</div>
</div>
  <script src="script.js"></script>
</body>

</html>