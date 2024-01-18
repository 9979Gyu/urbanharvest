<?php
// Include your database connection here (adjust the details accordingly)
include_once '../connect.php';

// Fetch counts of bookings based on payment status
function fetchPaymentStatusCounts() {
    global $conn;

    $sql = "SELECT 
                CASE 
                    WHEN paymentStatus = 1 THEN 'PAID'
                    WHEN paymentStatus = 2 THEN 'PENDING'
                    WHEN paymentStatus = 3 THEN 'CANCEL'
                    ELSE 'NOT PAID'
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