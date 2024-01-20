<?php

include_once '../connect.php';

function fetchUserCountsByRole() {
    global $conn;

    $sql = "SELECT `roleID`, COUNT(*) AS `count` FROM `user` WHERE `roleID` != 1 GROUP BY `roleID`";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error fetching data: " . mysqli_error($conn));
    }

    $data = array(); // Initialize an array to store the fetched data

    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['roleID']] = intval($row['count']);
    }

    return $data;
}
?>
