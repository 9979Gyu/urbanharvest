<?php
session_start();
include('../connect.php');

$userID = $_POST['userID'];

if (isset($_POST['update'])) {
    // Handle form submission for updating new staff
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $address = $_POST['homeAddress'];
    $password = $_POST['password'];

    $sql = $conn->prepare("UPDATE user SET firstName = ?, lastName = ?, email = ?, contactNo = ?, homeAddress = ?, password = ? WHERE userID = ?");
    $sql->bind_param("ssssssi", $firstName, $lastName, $email, $contactNo, $address, $password, $userID);

    if ($sql->execute() === TRUE) {
        echo "<script>alert('Data has been updated!'); window.location.href='viewprofile.php';</script>";
    } else {
        echo "<script>alert('Error updating record'); window.location.href='viewprofile.php';</script>";
    }

    $sql->close();
} else if (isset($_POST['cancel'])) {
    echo "<script> window.location.href='viewprofile.php';</script>";
}

$conn->close();
?>
