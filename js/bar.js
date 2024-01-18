// Get the data from PHP
var bookingPlotsCounts = bookingPlotsCountsData;

// Extract data for the bar graph
var bookingMonths = bookingPlotsCounts.map(count => count.formattedMonth);
var plotCounts = bookingPlotsCounts.map(count => count.plotCount);

// Manually specify x-axis labels (months)
var xAxisLabels = bookingMonths;

// Get the canvas element
var canvas = document.getElementById('barGraph');

// Create a bar graph
var barGraph = new Chart(canvas, {
    type: 'bar',
    data: {
        labels: xAxisLabels,
        datasets: [{
            label: 'Booking Plots Count',
            data: plotCounts,
            backgroundColor: generateRandomColors(plotCounts.length),
            borderWidth: 1
        }]
    },
    options: {
        maintainAspectRatio: false,
        responsive: false,
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Month'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Booking Plots Count'
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

// Function to generate an array of random colors
function generateRandomColors(count) {
    var colors = [];
    for (var i = 0; i < count; i++) {
        var randomColor = 'rgba(' +
            Math.floor(Math.random() * 256) + ',' +
            Math.floor(Math.random() * 256) + ',' +
            Math.floor(Math.random() * 256) + ', 0.7)';
        colors.push(randomColor);
    }
    return colors;
}
