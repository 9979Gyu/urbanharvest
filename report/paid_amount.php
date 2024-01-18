<?php
// Include necessary PHP files and logic to fetch data
include_once '../connect.php';
include_once '../report/fetch_data/fetch_paid_amount.php';

// Fetch total paid amount by month
$paidAmounts = fetchPaidAmountByMonth();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../head.php'; ?>
   

    <!-- Display payment amounts by month -->
    <div class="chart-wrapper">
        <!-- Table Container -->
        <div class="table-container">
            <br><h2 class="chart-title">Total Paid Amount by Month</h2><br>
            <table>
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Total Paid Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($paidAmounts as $paidAmount): ?>
                        <tr>
                            <td><?php echo $paidAmount['formattedMonth']; ?></td>
                            <td><?php echo $paidAmount['totalPaidAmount']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Chart Container -->
        <div class="chart-container">
            <canvas id="lineGraph" width="300" height="150"></canvas>
        </div>
    </div>

    <!-- Pass PHP data to JavaScript -->
    <script>
        var paidAmountsDataPHP = <?php echo json_encode($paidAmounts); ?>;
    </script>

    <!-- Include the external JavaScript file -->
    <script src="../js/line.js"></script>

    <?php include '../foot.php'; ?>
</body>
</html>
