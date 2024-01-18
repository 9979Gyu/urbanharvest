<?php
// Include your database connection here (adjust the details accordingly)
include_once '../connect.php';

// Fetch the count of booking plots made by customers for each month
function fetchBookingPlotsCountByMonth() {
    global $conn;

    // Implement the logic to retrieve booking plots count data
    $sql = "SELECT
            DATE_FORMAT(bookDateTime, '%Y-%m') as formattedMonth,
            COUNT(DISTINCT plotID) as plotCount
        FROM booking
        GROUP BY formattedMonth
        ORDER BY formattedMonth";


    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error fetching booking plots count: " . mysqli_error($conn));
    }

    $bookingPlotsCount = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $bookingPlotsCount[] = $row;
    }

    return $bookingPlotsCount;
}
?>
