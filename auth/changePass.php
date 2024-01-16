<?php
session_start();
require("../connect.php");

if (isset($_POST['submit'])) {
    // Retrieve user information from the session
    $email = $_SESSION['email'];

    // Retrieve new password and confirm password from the form
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];

    // Check if new password matches the confirm password
    if ($newPassword === $confirmPassword) {
        // Hash the new password before storing it in the database
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the user table
        $updatePasswordQuery = "UPDATE user SET password = '$hashedPassword' WHERE email = '$email'";

        if ($conn->query($updatePasswordQuery) === TRUE) {
            echo "Password updated successfully!";
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=login.html\">";
        } else {
            echo "Error updating password: " . $conn->error;
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=changePass.php\">";
        }
    } else {
        echo "Passwords do not match!";
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=changePass.php\">";
    }
} else {
    echo "Invalid request!";
    echo "<meta http-equiv=\"refresh\" content=\"3;URL=changePass.php\">";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Urban Harvest-Change Password</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="icon" href="../assets/img/logo.png"/>
        <link rel="stylesheet" href="../css/authStyle.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="regisForm">
            <form action="changePass.php" method="post">
                <table>
                    <tr>
                        <th colspan="2"><p class="title">Change Password</p></th>
                    </tr>
                    
                    <tr>
                        <td><label>New Password:</label></td>
                        <td>
                            <input type="password" name="password" placeholder="Enter password" required/>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Confirm Password:</label></td>
                        <td>
                            <input type="password" name="confirmpassword" placeholder="Enter password" required/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <center>
                                <button type="submit" name="submit">Proceed</button>
                                <button type="reset" name="reset">Clear</button>
                            </center>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>