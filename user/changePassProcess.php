<?php
session_start();
require("../connect.php");

if (isset($_POST['submit'])) {
    // Retrieve user information from the session
    $email = $_POST['email'];

    // Retrieve new password and confirm password from the form
    $newPassword = $_POST['newpass'];
    $confirmPassword = $_POST['confirmpassword'];

    // Check if new password matches the confirm password
    if ($newPassword === $confirmPassword) {
        // Hash the new password before storing it in the database
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // Update the password in the user table
        $updatePasswordQuery = "UPDATE user SET password = '$hashedPassword' WHERE email = '$email'";

        if ($conn->query($updatePasswordQuery) === TRUE) {
            echo "Password for email $email updated successfully!";
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=viewprofile.php\">";
        } else {
            echo "Error updating password: " . $conn->error;
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=viewprofile.php\">";
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