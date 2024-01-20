document.addEventListener("DOMContentLoaded", function () {
    var chartData = approvalChartData;
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
