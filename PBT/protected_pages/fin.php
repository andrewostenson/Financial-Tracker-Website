<?php 
include '../config/load_theme.php';
include '../config/config.php';

if (!isset($_SESSION['username'])) { //Makes sure username is set
    header("Location: ../account_managment/login.html");
    exit();
}

$name = $_SESSION['username']; //Store username from session

// Fetch finance records for the logged-in user
$SQL = "SELECT * FROM finances WHERE username= ?";
$stmt = $conn->prepare($SQL);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Income/Expenses</title>
    <link href="../style.css" rel="stylesheet">
</head>
<body class="<?php echo $userTheme; ?>">
    <div class ="header-container">
        <h1>Income Tracker</h1>
        <nav class="nav-bar">
            <a href="home.php">Home</a>
            <a href="fin.php" class = "current-page">Income/Expenses</a>
            <a href="stockview.php">Live Stock View</a>
            <a href ="settings.php">Settings</a>
        </nav>
    </div>
    <p>Here you can track your income and expenses as well as view a visual representation of your spending habits. 
        This page allows you to add, view, and delete financial entries to help you manage your budget effectively.
        Tools like this are essential for maintaining financial health and achieving your monetary goals.
    </p>

    <p>Tracking your finances regularly helps you identify patterns and make informed decisions about your spending and saving habits.
        By categorizing your income and expenses, you can see where your money is going and adjust accordingly.
        Use the form below to add new entries, and watch the pie chart update to reflect your spending distribution.
    </p>
    <table border="1" class = "finance-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Value</th>
                <th>Date</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody> 
         <?php while ($row = $result->fetch_assoc()): ?> 
                <tr id ="row-<?= $row['id'] ?>">
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= ($row['value'] < 0 ? '-' : '') . '$' . number_format(abs($row['value']), 2) ?></td>
                    <td><?= htmlspecialchars($row['date']) ?></td>
                    <td>
                        <button class = "delete-button" data-id="<?= $row['id'] ?>">
                            <img src = "../images/deleteicon.png" class="table-icon" alt="Delete">
                        </button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3>Add Entry</h3>
    <form id="addForm">
        <label for="title">Category</label>
        <select name="title" id="title" required>
            <option value="">-- Select Category --</option>
            <option value="Salary">Salary</option>
            <option value = "Rent/Mortgage">Rent/Mortgage</option>
            <option value="Groceries">Groceries</option>
            <option value="Transportation">Transportation</option>
            <option value="Utilities">Utilities</option>
            <option value="Healthcare">Healthcare</option>
            <option value="Entertainment">Entertainment</option>
            <option value="Miscellaneous">Miscellaneous</option>
        </select>        

        <input type="number" step="0.01" name="value" placeholder="Value" required>

        <input type="date" name="date" value = "<?php echo date('Y-m-d'); ?>" required>

        <button type="submit">Add Row</button>
    </form>

    <h3>Expense pie chart</h3>
    <p>As you add entries, this chart will update to show the distribution of your expenses.</p>
    <p>(Note: Only expenses are included in this chart, income can be viewed on the home page)</p>
    <canvas id="financeChart"></canvas>

  <script src="../dynamic_table/finance.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../dynamic_table/chart.js"></script>
</body>
</html>