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
            <a href="stockview.php" class = "current-page">Live Stock View</a>
            <a href ="settings.php">Settings</a>
        </nav>
    </div>

    <h2>The Live Stock Market</h2>
    <p>The stock market can be an overwhelming concept to understand,
        but with the right tools and resources, anyone can learn to navigate it effectively.
        Below is a live stock chart that updates in real-time to help you stay informed about market trends.
        This is intended to help you understand the basics of stock market movements and how they can impact your financial planning.
    </p>

    <p>This graph updates in real-time (every 75 seconds), in order to provide you with the most current market information.
        Note that there may be slight delays due to data fetching and processing times.
        Unfortunately, this is not designed to track personal investments, but rather to give a general overview of market trends.
        Here, we can use this live information to introduce some basic investment concepts that may be useful in your financial journey.
    </p>

    <h3>Displayed Stocks</h3>
    <p>Our chart here displays the top 5 tech companies by market capitalization: Google, Apple, Microsoft, Amazon, and NVIDIA.</p>
    <canvas id="stockChart"></canvas>

    <h3>Reading the Chart</h3>
    <p>The chart displays the stock prices of the selected companies over time, allowing you to observe trends and fluctuations in the market.
        The x-axis represents time, while the y-axis represents the stock price in USD.
        Each line corresponds to a different company, with distinct colors for easy identification.
        By analyzing the chart, you can gain insights into how external factors, such as market news or economic events, can influence stock prices.
    </p>

    <p>As an informative tool, you could use this chart to familiarize yourself with how stock prices move and what factors might influence these movements.
        Remember, investing in the stock market carries risks, and it's important to conduct thorough research or consult with a financial advisor before making any investment decisions.
        As you looked at stock data from day-to-day, week-to-week, or month-to-month, you could start to see patterns and trends that may help inform your understanding of market behavior.
    </p>

    <p>In the real world, tools likes this can be modified to include the purchasing and selling of stocks, portfolio tracking, and personalized investment advice.
        However, for the purposes of this introductory budget tracker, we aim to provide a simple overview of stock market trends to help you get started on your financial education journey.
        If you ever decide to explore investing further, remember to always do so with caution and informed decision-making.
    </p>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="stockapi.js"></script>
</body>
</html>