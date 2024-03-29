<?php
    session_start();

    include_once '../connect.php';
    include_once '../report/fetch_data/fetch_payment_status.php';
   
    $paymentStatusCounts = fetchPaymentStatusCounts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png"/>
    <title>Payment Status Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
    
<body>
    <?php include '../head.php'; ?> 

    <div class="chart-wrapper">
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
                        $displayOrder = ['PAID', 'PENDING', 'CANCELLED'];

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

        <div class="chart-container">
            <canvas id="pieChart" width="250" height="350"></canvas>
        </div>
    </div>

    <script>
        var paymentStatusCountsPHP = <?php echo json_encode($paymentStatusCounts); ?>;
    </script>

    <script src="../js/pie.js"></script>
    
    <?php include '../foot.php'; ?> 
</html>
