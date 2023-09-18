<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
    // Fetch JSON data from BookingsPieChart.php
    fetch('/C-rental/AdminDash/Controllers/AdminControllers/BookingsPieChart.php')
        .then(response => response.json())
        .then(data => {
            const bookingStatusData = data.statusCounts;
            renderChart(bookingStatusData);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });

    function renderChart(bookingStatusData) {
        var chart = new CanvasJS.Chart("pieChartContainer", {
            theme: "light1",
            exportFileName: "Doughnut Chart",
            exportEnabled: true,
            animationEnabled: true,
            title: {
                text: "Bookings"
            },
            legend: {
                cursor: "pointer",
                itemclick: explodePie
            },
            data: [{
                type: "doughnut",
                innerRadius: 90,
                showInLegend: true,
                toolTipContent: "<b>{name}</b>: {y}",
                indexLabel: "{name} - {y}",
                dataPoints: bookingStatusData
            }]
        });
        chart.render();

        function explodePie(e) {
            if (typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
                e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
            } else {
                e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
            }
            e.chart.render();
        }
    }
}
</script>
</head>
<body>
<div id="pieChartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>
