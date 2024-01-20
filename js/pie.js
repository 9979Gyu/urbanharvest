var paymentStatusCounts = paymentStatusCountsPHP;
var canvas = document.getElementById('pieChart');

var pieChart = new Chart(canvas, {
    type: 'pie',
    data: {
        labels: Object.keys(paymentStatusCounts),
        datasets: [{
            data: Object.values(paymentStatusCounts),
            backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)'
                // Add more colors as needed
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        title: {
            display: true,
            text: 'Payment Status Distribution'
        }
    }
});
