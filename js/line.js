document.addEventListener("DOMContentLoaded", function () {
    var paidAmountsData = paidAmountsDataPHP;
    var months = paidAmountsData.map(data => data.formattedMonth);
    var paidAmounts = paidAmountsData.map(data => data.totalPaidAmount);

    var ctx = document.getElementById('lineGraph').getContext('2d');
    var lineGraph = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                data: paidAmounts,
                backgroundColor: 'rgba(0, 123, 255, 0.5)',
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false // Hide the legend
                }
            }
        }
    });
});
