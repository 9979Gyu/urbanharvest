<?php
session_start();
include('../connect.php');

$userID = $_POST['userID'];

if (isset($_POST['update'])) {
    // Handle form submission for updating profile
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $address = $_POST['homeAddress'];

    $sql = $conn->prepare("UPDATE user SET firstName = ?, lastName = ?, email = ?, contactNo = ?, homeAddress = ? WHERE userID = ?");
    $sql->bind_param("sssssi", $firstName, $lastName, $email, $contactNo, $address, $userID);

    if ($sql->execute() === TRUE) {
        echo "<script>alert('Profile has been updated!'); window.location.href='viewprofile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile'); window.location.href='viewprofile.php';</script>";
    }

    $sql->close();
} else if (isset($_POST['cancel'])) {
    echo "<script> window.location.href='viewprofile.php';</script>";

}else if (isset($_POST['updatechange'])) {
    // Handle form submission for updating new password
    $password = $_POST['newpass'];
    $hashPwd = password_hash($password, PASSWORD_BCRYPT);
    $sql = $conn->prepare("UPDATE user SET password = ? WHERE userID = ?");
    $sql->bind_param("si", $hashPwd, $userID);


    if ($sql->execute() === TRUE) {
        echo "<script>alert('Password has been changed for ($userID)!'); window.location.href='viewprofile.php';</script>";
    } else {
        echo "<script>alert('Failed to change password'); window.location.href='viewprofile.php';</script>";
    }

    $sql->close();
}

$conn->close();
?>