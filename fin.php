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
    <title>Income/Expenses</title>
    <link href="style.css" rel="stylesheet">
</head>
<body class="<?php echo $userTheme; ?>">
    <h1 class="page-header">Net Income Tracker</h1>
    <nav class="nav-bar">
        <a href="home.php">Home</a>
        <a href="fin.php">Income/Expenses</a>
        <a href ="settings.php">Settings</a>
        <a href="account.php">Account</a>
    </nav>
    <p>Here you can track your income and expenses, rate of spending, and other financial information.</p>
    <table border= 1>
        <thead>
            <tr>
                <th>Title</th>
                <th>Value</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Groceries</td>
                <td>-$54.23</td>
                <td>2025-10-20</td>
            </tr>
            <tr>
                <td>Electricity Bill</td>
                <td>-$120.50</td>
                <td>2025-10-18</td>
            </tr>
            <tr>
                <td>Coffee Shop</td>
                <td>-$8.75</td>
                <td>2025-10-21</td>
            </tr>
            <tr>
                <td>Online Purchase</td>
                <td>-$45.99</td>
                <td>2025-10-22</td>
            </tr>
            <tr>
                <td>Salary</td>
                <td>$3,500.00</td>
                <td>2025-10-15</td>
            </tr>
        </tbody>
</table>
    <p class="tooltip">Date last updated...</p> 
    <button>Save changes</button>
    <button>Add row</button>
    <button>Delete row</button>
    <button>Update row</button>
  <script src="script.js"></script>
</body>
</html>