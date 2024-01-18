<?php
session_start();
include('../../connect.php');

$userID = $_POST['userID'];

if (isset($_POST['update'])) {
    // Handle form submission for updating new staff
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $address = $_POST['homeAddress'];

    $sql = $conn->prepare("UPDATE user SET firstName = ?, lastName = ?, email = ?, contactNo = ?, homeAddress = ? WHERE userID = ?");
    $sql->bind_param("sssssi", $firstName, $lastName, $email, $contactNo, $address, $userID);

    if ($sql->execute() === TRUE) {
        echo "<script>alert('Data Customer $userID successfully updated!'); window.location.href='admin-custList.php';</script>";
    } else {
        echo "<script>alert('Error updating record'); window.location.href='admin-custList.php';</script>";
    }

    $sql->close();
} else if (isset($_POST['cancel'])) {
    echo "<script> window.location.href='admin-custList.php';</script>";
}

$conn->close();
?>
