document.addEventListener("DOMContentLoaded", function () {
    // Your JavaScript code for approval_status.php
    // Parse JSON data and create the donut chart
    var chartData = approvalChartData; // Use the data from PHP

    // Extract labels and values from the data
    var labels = Object.keys(chartData);
    var values = Object.values(chartData);

    var ctx = document.getElementById('financialChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: ['blue', 'orange', 'green', 'red'],
                borderWidth: 2,
            }]            
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            title: {
                display: true,
                text: 'Book Approval Status'
            }
        }
    });
});
