<?php
session_start();
require("../connect.php");

if (isset($_POST['updatechange'])) {
    // Retrieve user information from the session
    $id = $_POST['id'];

    // Retrieve new password and confirm password from the form
    $newPassword = $_POST['newpass'];
    $confirmPassword = $_POST['confirmpass'];

    // Check if new password matches the confirm password
    if ($newPassword === $confirmPassword) {
        // Hash the new password before storing it in the database
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // Update the password in the user table
        $updatePasswordQuery = "UPDATE user SET password = '$hashedPassword' WHERE userID = '$id'";

        if ($conn->query($updatePasswordQuery) === TRUE) {
            echo "Password for id $id updated successfully!";
            echo "<meta http-equiv=\"refresh\" content=\"5;URL=viewprofile.php\">";
        } else {
            echo "Error updating password: " . $conn->error;
            echo "<meta http-equiv=\"refresh\" content=\"2;URL=viewprofile.php\">";
        }
    } else {
        echo "Passwords do not match!";
        echo "<meta http-equiv=\"refresh\" content=\"2;URL=viewprofile.php\">";
    }
} else {
    echo "Invalid request!";
    echo "<meta http-equiv=\"refresh\" content=\"2;URL=viewprofile.php\">";
}

$conn->close();
?>