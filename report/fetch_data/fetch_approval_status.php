<?php
// Include your database connection here (adjust the details accordingly)
include_once '../connect.php';

// Change fetchApprovalCounts() in fetch_approval_status.php
function fetchApprovalCounts() {
    global $conn;

    $sql = "SELECT
                CASE 
                    WHEN `bookApproval` = 1 THEN 'APPROVED'
                    WHEN `bookApproval` = 2 THEN 'PENDING'
                    ELSE 'DECLINED'
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