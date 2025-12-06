//Interactive Stock Price Fetcher using Alpha Vantage API
const apikey = "JXBQ2GDS1ELIP7R1";
const updateInterval = 75000; // Update every 75 seconds
const stocks = ["AAPL", "GOOGL", "MSFT", "AMZN", "NVDA"]; // List of stock symbols to track
const stockData = {};
let stockChart = null;

//Colors for the chart
const stockColors = {
    "AAPL": 'rgba(0, 0, 0, 1)',
    "GOOGL": 'rgba(255, 0, 0, 1)',
    "MSFT": 'rgba(255, 206, 86, 1)',
    "AMZN": 'rgba(34, 172, 6, 1)',
    "NVDA": 'rgba(153, 102, 255, 1)'
}

//Set up arrays for data storage
stocks.forEach(symbol => {
    stockData[symbol] = {prices: [],timestamps: []};
});

//Function to fetch stock data from Alpha Vantage API
function fetchStockData(symbol) {
    fetch(`https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol=${symbol}&apikey=${apikey}`)
        .then (response => response.json())
        .then (data => {
            const quoteData = data["Global Quote"];
            if (!quoteData) {return;}

            const price = parseFloat(quoteData["05. price"]);
            const now = new Date();

            stockData[symbol].prices.push(price);
            stockData[symbol].timestamps.push(now);

            if (stockData[symbol].prices.length > 20) {
                stockData[symbol].prices.shift();
                stockData[symbol].timestamps.shift();
            }
            renderChart();
        })
        .catch (error => console.error("Error fetching stock data:", error));
}

//Render the chart
function renderChart() {
    //Prepare data
    const labels = stockData[stocks[0]].timestamps.map(ts => ts.toLocaleTimeString());

    //Format datasets
    const datasets = stocks.map(symbol => ({
        label: symbol,
        data: stockData[symbol].prices,
        borderColor: stockColors[symbol],
        backgroundColor: 'rgba(0, 0, 0, 0)',
        fill: false,
        tension: 0.1
    }));

    const ctx = document.getElementById('stockChart').getContext('2d');

    //If chart exists, update it; otherwise, create a new one
    if (stockChart) {
        stockChart.data.labels = labels;
        stockChart.data.datasets = datasets;
        stockChart.update();
    } 
    else {
        stockChart = new Chart(ctx, {
            type: 'line',
            data: {labels, datasets},
            options : {
                responsive: true,
                plugins: {
                    legend: {position: 'top',}
                },
                scales: {
                    y: {beginAtZero: false}
                }
            }
        });
    }
}

//Initial fetch and set interval for updates
stocks.forEach(symbol => {
    fetchStockData(symbol);
    setInterval(() => fetchStockData(symbol), updateInterval);
});