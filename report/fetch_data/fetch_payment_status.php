<?php

include_once '../connect.php';

function fetchPaymentStatusCounts() {
    global $conn;

    $sql = "SELECT 
                CASE 
                    WHEN paymentStatus = 0 THEN 'PENDING'
                    WHEN paymentStatus = 1 THEN 'PAID'
                    ELSE 'CANCELLED'
                END AS paymentStatusText,
                COUNT(*) AS count
            FROM booking
            GROUP BY paymentStatusText";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error fetching payment status counts: " . mysqli_error($conn));
    }

    $paymentStatusCounts = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $paymentStatusCounts[$row['paymentStatusText']] = $row['count'];
    }

    return $paymentStatusCounts;
}
?>
