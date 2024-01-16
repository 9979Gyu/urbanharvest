<?php
session_start();

include('../connect.php');

// Check if the userID is provided in the URL
if (isset($_GET['questionID'])) {
    $questionID = $_GET['questionID'];

    $sql = "UPDATE question SET status = 0 WHERE questionID = '" . $questionID . "'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Question $questionID has been deleted'); window.location.href='manage-security.php';</script>";
    } else {
        echo "<p>";
        echo "<p style='text-align:center'>Error updating status: " . $conn->error;
        echo "<script>window.location.href='manage-security.php';</script>";
        echo "<p>";
    }
} else {
    // Handle the case where userID is not provided in the URL
    echo "<p style='text-align:center'>UserID not provided.</p>";
    echo "<script>window.location.href='manage-security.php';</script>";
}

$conn->close();
?>