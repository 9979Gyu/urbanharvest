<?php
session_start();

if(!isset($_SESSION['email'])){
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
}

    include('../connect.php');

    $userID = $_POST["userID"];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $address = $_POST['homeAddress'];
    $role = $_POST['role'];

    $_SESSION['role'] = $role;
    $_SESSION['fname'] = $firstName;

    $sql = $conn->prepare("UPDATE user SET firstName = ?, lastName = ?, contactNo = ?, homeAddress = ? WHERE userID = ?");
    $sql->bind_param("ssssi", $firstName, $lastName, $contactNo, $address, $userID);

    if ($sql->execute() === TRUE) {
        echo "<script>alert('Profile has been updated!');window.location.href='viewprofile.php';</script>";
        // echo "<meta http-equiv=\"refresh\" content=\"10;URL=viewprofile.php\">";

    } else {
        echo "<script>alert('Error updating profile'); window.location.href='viewprofile.php';</script>";
    }

    $sql->close();


$conn->close();
?>
