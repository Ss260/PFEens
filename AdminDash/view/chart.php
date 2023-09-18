<!DOCTYPE HTML>
<html>
<head>  
<script>
(function() {
    fetch('/C-rental/AdminDash/Controllers/AdminControllers/fetch_monthly_earnings.php')
        .then(response => response.json())
        .then(data => {
            const monthlyEarningsData = data.monthlyEarnings;
            renderChart(monthlyEarningsData);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });

    function renderChart(monthlyEarningsData) {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light1",
            title: {
                text: "Monthly Earnings"
            },
            axisY: {
                title: "Amount"
            },
            data: [{
                type: "column",
                showInLegend: true,
                legendText: "Months",
                dataPoints: [
                    { y: monthlyEarningsData[1], label: "January" },
                    { y: monthlyEarningsData[2], label: "February" },
                    { y: monthlyEarningsData[3], label: "March" },
                    { y: monthlyEarningsData[4], label: "April" },
                    { y: monthlyEarningsData[5], label: "May" },
                    { y: monthlyEarningsData[6], label: "June" },
                    { y: monthlyEarningsData[7], label: "July" },
                    { y: monthlyEarningsData[8], label: "August" },
                    { y: monthlyEarningsData[9], label: "September" },
                    { y: monthlyEarningsData[10], label: "October" },
                    { y: monthlyEarningsData[11], label: "November" },
                    { y: monthlyEarningsData[12], label: "December" }
                ]
            }]
        });
        chart.render();
    }
})();
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>

 