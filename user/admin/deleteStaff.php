

<?php
session_start();

include('../../connect.php');

$userID = $_REQUEST['userID'];

$sql = "UPDATE user SET status = 0 WHERE userID = '" . $userID . "' AND status = 1";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Account Staff with ID $userID has been deactivated'); window.location.href='admin-add-staff.php';</script>";

} else {
    echo "<p>";
    echo "<p style='text-align:center'>Error updating status: " . $conn->error;
    echo "<script>window.location.href='admin-add-staff.php';</script>";
    echo "<p>";
}

$conn->close();
?>
