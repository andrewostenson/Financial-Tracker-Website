<?php 
include '../config/load_theme.php';
include '../config/config.php';

if (!isset($_SESSION['username'])) { //Makes sure username is set
    header("Location: ../account_managment/login.html");
    exit();
}

$name = $_SESSION['username']; //Store username from session

//Fetch total income for the logged-in user
$sql = "SELECT SUM(value) as total_income FROM finances WHERE username = ? AND value > 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$totalIncome = $row['total_income'] ?? 0;

//Fetch total expenses for the logged-in user
$sql = "SELECT SUM(value) as total_expense FROM finances WHERE username = ? AND value < 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$totalExpense = $row['total_expense'] ?? 0;

//Calculate net balance
$netBalance = $totalIncome + $totalExpense;

$sql = "SELECT MAX(date) as last_update FROM finances WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$lastUpdate = $row['last_update'] ?? 'No updates yet';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link href="../style.css" rel="stylesheet">
</head>
<body class="<?php echo $userTheme; ?>">
    <div class ="header-container">
        <h1><?php echo $name ?>'s Dashboard</h1>
        <nav class="nav-bar">
            <a href="home.php">Home</a>
            <a href="fin.php">Income/Expenses</a>
            <a href="stockview.php">Live Stock View</a>
            <a href ="settings.php">Settings</a>
            <a href = "help.php">Help</a>
        </nav>
    </div>

    <p>This is your personal online budget tracker! Here you can track your income, expenses, and accounts.</p>
    <h2>Financial Overview</h2>
    <p>[PREVIOUS WEEK INCOME]: $<?= number_format($totalIncome, 2) ?></p><br>
    <p>[PREVIOUS WEEK EXPENSE]: $<?= number_format($totalExpense, 2) ?></p><br>
    <p>[NET ACCOUNT BALANCE]: $<?= number_format($netBalance, 2) ?></p><br>
    <p>[DATE OF LAST ACCOUNT UPDATE]: <?= $lastUpdate ?></p><br>

    <a href="/PBT/account_managment/">View All Users</a>
    <a href="/PBT/account_managment/register.html">Register Another User</a><br>
    <p>To-do: chart, stock market api, delete.php, auto negatives for table, email verification, help page</p>
  <script src="../script.js"></script>
</body>
</html>
