<?php
// Include necessary PHP files and logic to fetch data
include_once '../connect.php';
include_once '../report/fetch_data/fetch_user_count.php';

// Fetch user counts by role
$userCounts = fetchUserCountsByRole();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Role Counts</title>

    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

    <!-- Link to your external CSS file -->
    <link rel="stylesheet" href="../style.css">
    
</head>
<body>
    <?php include '../head.php'; ?> <!-- Include the header file -->

    <!-- Flex container for both the table and the chart -->
    <div class="chart-wrapper">
        <!-- Table container -->
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
   
    <!-- Chart container -->
    <div class="chart-container">
        <canvas id="userRoleChart" width="500" height="350"></canvas>
    </div>
</div>

<!-- Pass PHP data to JavaScript -->
<script>
    var userCountsData = <?php echo json_encode($userCounts); ?>;
</script>

<!-- Include the external JavaScript file -->
<script src="../js/h-bar.js"></script>

<?php include '../foot.php'; ?> <!-- Include the footer file -->
</body>
</html>
