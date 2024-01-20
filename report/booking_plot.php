<?php
session_start();

// Include necessary PHP files and logic to fetch data
include_once '../connect.php';
include_once '../report/fetch_data/fetch_booking_plot.php';

// Fetch booking requests made by customers
$bookingPlotsCounts = fetchBookingPlotsCountByMonth();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png"/>
    <title>Booking Plot Report</title>

    <!-- Link to Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Link to your external CSS file -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../head.php'; ?> <!-- Include the header file -->

    <!-- Display booking requests made by customers -->
    <div class="chart-wrapper">
        <!-- Table Container -->
        <div class="table-container">
        <br><h2 class="chart-title">Booking Plots by Month</h2><br>
            <table>
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Booking Plots Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookingPlotsCounts as $request): ?>
                        <tr>
                            <td><?php echo $request['formattedMonth']; ?></td>
                            <td><?php echo $request['plotCount']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Chart Container -->
        <div class="chart-container">
            <!-- Add a canvas element for the bar graph -->
            <canvas id="barGraph" width="500" height="350"></canvas>
        </div>
    </div>

    <!-- Pass PHP data to JavaScript -->
    <script>
        var bookingPlotsCountsData = <?php echo json_encode($bookingPlotsCounts); ?>;
    </script>

    <!-- Include the external JavaScript file -->
    <script src="../js/bar.js"></script>

    <?php include '../foot.php'; ?> <!-- Include the footer file -->
</body>
</html>
