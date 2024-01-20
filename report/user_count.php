<?php
    session_start();

    include_once '../connect.php';
    include_once '../report/fetch_data/fetch_user_count.php';

    $userCounts = fetchUserCountsByRole();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png"/>
    <title>User Role Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="../css/style.css">
</head>
    
<body>
    <?php include '../head.php'; ?> 

    <div class="chart-wrapper">
        <div class="table-container">
            <br><h2 class="chart-title">Total of Users</h2><br>
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userCounts as $roleID => $count): ?>
                        <tr>
                            <td><?= $roleID === 2 ? 'Staff (' . $roleID . ')' : 'Customer (' . $roleID . ')'; ?></td>
                            <td><?= $count; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
   
    <div class="chart-container">
        <canvas id="userRoleChart" width="500" height="350"></canvas>
    </div>
</div>

<script>
    var userCountsData = <?php echo json_encode($userCounts); ?>;
</script>

<script src="../js/h-bar.js"></script>

<?php include '../foot.php'; ?>
</body>
</html>
