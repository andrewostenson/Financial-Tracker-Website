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
            <a href="fin.php">Income/Expenses</a>
            <a href="stockview.php">Live Stock View</a>
            <a href ="settings.php">Settings</a>
            <a href = "help.php">Help</a>
        </nav>
    </div>
    <p>Here you can track your income and expenses, rate of spending, and other financial information.</p>
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
                <tr>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td>$<?= htmlspecialchars($row['value']) ?></td>
                    <td><?= htmlspecialchars($row['date']) ?></td>
                    <td>
                        <form action="../dynamic_table/delete_row.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit"><img src="../images/deleteicon.png" alt="Delete" class="table-icon"></button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3>Add Entry</h3>
    <form action="../dynamic_table/add_row.php" method="POST">
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

    <h3>Chart</h3>
    <canvas id="financeChart" width="400" height="200"></canvas>

  <script src="../script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>