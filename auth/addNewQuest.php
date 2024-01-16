<?php
include('../connect.php');

$sentence = $_POST['sentence'];
$status = 1;

// Check if the sentence already exists in the table
$checkSql = "SELECT * FROM question WHERE sentence = '$sentence'";
$checkResult = $conn->query($checkSql);

if ($checkResult->num_rows > 0) {
    // Sentence already exists, show alert
    echo "<script>alert('Question already exists!'); window.location.href='manage-security.php';</script>";
} else {
    // Sentence doesn't exist, proceed with the insertion
    $sql = "INSERT INTO question (sentence, status) VALUES ('$sentence', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New question added!'); window.location.href='manage-security.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the specified connection
$conn->close();
?>
