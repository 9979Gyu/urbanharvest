<?php
    session_start();
    
    // Include necessary PHP files and logic to fetch data
    include_once '../connect.php';
    include_once '../report/fetch_data/fetch_payment_status.php';
    
    // Fetch counts of bookings based on status
    $paymentStatusCounts = fetchPaymentStatusCounts();
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status Report</title>

    <!-- Link to Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Link to your external CSS file -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../head.php'; ?> <!-- Include the header file -->

    <!-- Display payment status counts -->
    <div class="chart-wrapper">
        <!-- Table Container -->
        <div class="table-container">
            <br><h2 class="chart-title">Payment Status Counts</h2><br>
            <table>
                <thead>
                    <tr>
                        <th>Payment Status</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Define the display order
                        $displayOrder = ['PAID', 'PENDING', 'CANCEL', 'NOT PAID'];

                        // Display rows in the defined order
                        foreach ($displayOrder as $paymentStatus):
                            $count = isset($paymentStatusCounts[$paymentStatus]) ? $paymentStatusCounts[$paymentStatus] : 0;
                    ?>
                        <tr>
                            <td><?php echo $paymentStatus; ?></td>
                            <td><?php echo $count; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Chart Container -->
        <div class="chart-container">
            <canvas id="pieChart" width="250" height="350"></canvas>
        </div>
    </div>

    <!-- Pass PHP data to JavaScript -->
    <script>
        var paymentStatusCountsPHP = <?php echo json_encode($paymentStatusCounts); ?>;
    </script>

    <!-- Include the external JavaScript file -->
    <script src="../js/pie.js"></script>
    
    <?php include '../foot.php'; ?> <!-- Include the footer file -->
</body>
</html>
