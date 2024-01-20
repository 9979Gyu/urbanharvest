<?php
    session_start();

    include_once '../connect.php';
    include_once '../report/fetch_data/fetch_paid_amount.php';

    $paidAmounts = fetchPaidAmountByMonth();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png"/>
    <title>Payment Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="../css/style.css">
</head>
    
<body>
    <?php include '../head.php'; ?>
  
    <div class="chart-wrapper">
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

        <div class="chart-container">
            <canvas id="lineGraph" width="300" height="150"></canvas>
        </div>
    </div>

    <script>
        var paidAmountsDataPHP = <?php echo json_encode($paidAmounts); ?>;
    </script>

    <script src="../js/line.js"></script>

    <?php include '../foot.php'; ?>
</body>
</html>
