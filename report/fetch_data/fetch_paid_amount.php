<?php
// Include your database connection here (adjust the details accordingly)
include_once '../connect.php';

function fetchPaidAmountByMonth() {
    global $conn;

    // SQL to retrieve total paid amount per month
    $sql = "SELECT
            DATE_FORMAT(paymentDateTime, '%Y-%m') as formattedMonth,
            SUM(paidAmount) as totalPaidAmount
        FROM booking
        WHERE paymentStatus = '1'  -- Assuming you want to consider only paid amounts
        GROUP BY formattedMonth
        ORDER BY formattedMonth";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error fetching paid amounts: " . mysqli_error($conn));
    }

    $paidAmounts = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $paidAmounts[] = $row;
    }

    return $paidAmounts;
}

?>