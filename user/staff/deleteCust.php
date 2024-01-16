

<?php
session_start();

include('../../connect.php');

// Check if the userID is provided in the URL
if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    $sql = "UPDATE user SET status = 0 WHERE userID = '" . $userID . "'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Account with ID $userID has been deleted'); window.location.href='staff-custList.php';</script>";
    } else {
        echo "<p>";
        echo "<p style='text-align:center'>Error updating status: " . $conn->error;
        echo "<script>window.location.href='staff-custList.php';</script>";
        echo "<p>";
    }
} else {
    // Handle the case where userID is not provided in the URL
    echo "<p style='text-align:center'>UserID not provided.</p>";
}

$conn->close();
?>