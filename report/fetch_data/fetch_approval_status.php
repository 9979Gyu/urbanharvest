<?php

include_once '../connect.php';

function fetchApprovalCounts() {
    global $conn;

    $sql = "SELECT
                CASE 
                    WHEN `bookApproval` = 0 THEN 'PENDING'
                    WHEN `bookApproval` = 1 THEN 'APPROVED'
                    WHEN `bookApproval` = 2 THEN 'DECLINED'
                    ELSE 'CANCELLED'
                END AS `bookApprovalText`,
                COUNT(*) AS COUNT
            FROM `booking`
            GROUP BY `bookApprovalText`";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error fetching data: " . mysqli_error($conn));
    }

    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['bookApprovalText']] = $row['COUNT'];
    }

    return $data;
}
?>
