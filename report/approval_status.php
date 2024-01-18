<?php
    // Include necessary PHP files and logic to fetch data
    include_once '../connect.php';
    include_once '../report/fetch_data/fetch_approval_status.php';

    // Fetch approval counts
    $chartData = fetchApprovalCounts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approval Status Report</title>

    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include common CSS file -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../head.php'; ?> <!-- Include the header file -->

    <!-- Display financial table and graph -->
    <div class="chart-wrapper">
        <div class="table-container">
            <br><h2 class="chart-title">Approval Status Counts</h2><br>
            <table>
                <thead>
                    <tr>
                        <th>Booking Status</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($chartData as $status => $count):
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($status); ?></td>
                            <td><?php echo $count; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="chart-container">
            <canvas id="financialChart" width="250" height="350"></canvas>
        </div>
    </div>

    <!-- Pass PHP data to JavaScript -->
    <script>
        var approvalChartData = <?php echo json_encode($chartData); ?>;
    </script>

    <!-- Include the external JavaScript file -->
    <script src="../js/doughnut.js"></script>

    <?php include '../foot.php'; ?> <!-- Include the footer file -->
</body>
</html>
