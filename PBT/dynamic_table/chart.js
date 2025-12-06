//Intialize chart
let financeChart = null;

//Define category colors
const backgroundColors = {
    "Rent/Mortgage": "#FF6384",
    "Groceries": "#36A2EB",
    "Transportation": "#FFCE56",
    "Utilities": "#4BC0C0",
    "Healthcare": "#9966FF",
    "Entertainment": "#FF9F40",
    "Miscellaneous": "#C9CBCF"
};

//Render chart data
function renderChart() {
    const categoryTotals = {}; //Keep track of totals per category

    //Loop through data and add up all expenses
    document.querySelectorAll(".finance-table tbody tr").forEach(row => {
        const title = row.children[0].innerText;
        const valueText = row.children[1].innerText.replace("$", "");
        const value = parseFloat(valueText);

        if (value < 0) { //Only consider expenses
            if (!categoryTotals[title]) {
                categoryTotals[title] = Math.abs(value);
            }
            else {
                categoryTotals[title] += Math.abs(value);
            }
        }
    });

    //Prepare labels and data for chart
    const labels = Object.keys(categoryTotals);
    const data = Object.values(categoryTotals);

    return {labels, data};
}

//Update or create chart
function updateChart() {
    const ctx = document.getElementById("financeChart").getContext("2d");
    const {labels, data} = renderChart();

    const sliceColors = labels.map(label => backgroundColors[label] || "#AAAAAA"); //Map colors or default

    //Populate existing chart
    if (financeChart) {
        financeChart.data.labels = labels;
        financeChart.data.datasets[0].data = data;
        financeChart.data.datasets[0].backgroundColor = sliceColors;
        financeChart.update();
    } 
    
    //Create new chart
    else {
        financeChart = new Chart(ctx, {
            type: "pie",
            data: {
                labels: labels,
                datasets: [{
                    label: "Expenses",
                    data: data,
                    backgroundColor: sliceColors
                    
                }]
            }
        });
    }
}

//Initial chart rendering on page load
document.addEventListener("DOMContentLoaded", updateChart);
