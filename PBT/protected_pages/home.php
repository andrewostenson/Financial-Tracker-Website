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
            <a href="home.php" class = "current-page">Home</a>
            <a href="fin.php">Income/Expenses</a>
            <a href="stockview.php">Live Stock View</a>
            <a href ="settings.php">Settings</a>
        </nav>
    </div>

    <p>Welcome to your online budget tracker! The goal of this site is to introduce you to the idea of budgeting,
        tracking your expenses, and managing your finances better. By keeping a close eye on your income and expenses,
        you can make informed decisions about your spending habits and work towards achieving your financial goals.
    </p>
    <h2>Financial Overview</h2>
    <div class="dashboard-cards">
        <div class="card">
            <h3>Total Income</h3>
            <p>$<?= number_format($totalIncome, 2) ?></p>
        </div>
        <div class="card">
            <h3>Total Expenses</h3>
            <p>$<?= number_format($totalExpense, 2) ?></p>
        </div>
        <div class="card">
            <h3>Net Balance</h3>
            <p>$<?= number_format($netBalance, 2) ?></p>
        </div>
        <div class="card">
            <h3>Last Update</h3>
            <p><?= $lastUpdate ?></p>
        </div>
    </div>

    <h2>Who this site is for</h2>
    <p>Are you new to budgeting and want to take control of your finances? 
        This site is designed to help you get started with managing your money effectively.
        Tracking your income and expenses can feel overwhelming, but the aim here is to make it 
        as simple as possible and easy to understand.
    </p>

    <h2>How to use this site</h2>
    <p>Use the navigation menu to access different features such as tracking your income and expenses, viewing live stock market data, 
        and adjusting your settings. Regularly update your financial entries to keep your budget accurate and make informed 
        decisions based on the insights provided.
    </p>

    <p>
        This site is a starting point for your financial journey. As you become more comfortable with budgeting,
        you can explore additional features and tools to enhance your financial management skills.
        This is a tool intended to help you learn the basics of budgeting and financial tracking. Happy budgeting!
    </p>


</body>
</html>
