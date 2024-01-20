<?php
    session_start();

    include_once '../connect.php';
    include_once '../report/fetch_data/fetch_approval_status.php';

    $chartData = fetchApprovalCounts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png"/>
    <title>Approval Status Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="../css/style.css">
</head>
    
<body>
    <?php include '../head.php'; ?>

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

    <script>
        var approvalChartData = <?php echo json_encode($chartData); ?>;
    </script>

    <script src="../js/doughnut.js"></script>

    <?php include '../foot.php'; ?> 
</body>
</html>
