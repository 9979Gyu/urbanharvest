

<?php
session_start();

include('../../connect.php');

$userID = $_REQUEST['userID'];

$sql = "UPDATE user SET status = 1 WHERE userID = '" . $userID . "' AND status = 0";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Account with ID $userID has been activated'); window.location.href='staff-add-cust.php';</script>";

} else {
    echo "<p>";
    echo "<p style='text-align:center'>Error updating status: " . $conn->error;
    echo "<script>window.location.href='staff-add-cust.php';</script>";
    echo "<p>";
}

$conn->close();
?>
