document.addEventListener("DOMContentLoaded", function () {
    var userData = userCountsData;

    if (userData !== null && Object.keys(userData).length > 0) {
        var labels = Object.keys(userData);
        var values = Object.values(userData);

        var ctx = document.getElementById('userRoleChart').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: labels.map(function (roleID) {
                    return roleID === '2' ? 'Staff' : 'Customer';
                }),
                datasets: [{
                    data: values.map(function (count) {
                        return count;
                    }),
                    backgroundColor: labels.map(function (roleID) {
                        return roleID === '2' ? 'blue' : 'green'; // Blue for Staff, Green for Customer
                    }),
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Total User'
                        },
                        ticks: {
                            beginAtZero: false,
                            min: 0.5,
                            stepSize: 0.5
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'User'
                        }
                    }]
                },
                legend: {
                    display: false, // Hide the legend
                }
            }
        });
    } else {
        console.error('No data to create chart or there was an error.');
    }
});
