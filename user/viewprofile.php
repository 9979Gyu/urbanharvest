<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>My Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png"/>
    <link rel="stylesheet" href="../css/admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            // Hide the cancel button initially
            $("#cancelButton").hide();
            $("#updateButton").hide();
            $("#cancelChange").hide();
            $("#updateChange").hide();
            $("#newpasslabel").parent().hide();
            $("#confirmpasslabel").parent().hide()
            $("#newpassinput").parent().hide();
            $("#confirmpassinput").parent().hide()

            // Disable the input fields initially
            $("input").prop("disabled", true);

            // Enable input fields and show cancel button when "Edit" is clicked
            $("#editButton").click(function() {
                $("input").prop("disabled", false);
                $(this).hide();
                $("#passinput").prop("disabled", true);
                $("#newpassinput").prop("disabled", true);
                $("#confirmpassinput").prop("disabled", true);
                $("#updateButton").show();
                $("#cancelButton").show();
            });

            // Show "Edit" button and hide cancel button when "Cancel" is clicked
            $("#cancelButton").click(function() {
                $("#editButton").show();
                $(this).hide();
                $("#updateButton").hide();
                $("input").prop("disabled", true);
            });

            // Show password fields when "Change Password" is clicked
            $("#changepass").click(function() {
                $("#passinput").hide();
                $("#password").hide();
                $("#changepass").hide();
                $("#cancelChange").show();
                $("#updateChange").show();
                $("#newpasslabel").parent().show();
                $("#confirmpasslabel").parent().show()
                $("#newpassinput").parent().show();
                $("#confirmpassinput").parent().show()
                $("#passinput").prop("disabled", false);
                $("#newpassinput").prop("disabled", false);
                $("#confirmpassinput").prop("disabled", false);
            });

            // Hide password fields when "Cancel" is clicked during password change
            $("#cancelChange").click(function() {
                $("#passinput").show();
                $("#password").show();
                $("#passinput").val($("#oldpass").val());
                $("#newpasslabel").parent().hide();
                $("#confirmpasslabel").parent().hide();
                $(this).hide();
                $("#changepass").show();
                $("#updateChange").hide();
                $("#newpassinput").parent().hide();
                $("#confirmpassinput").parent().hide()
                $("#passinput").prop("disabled", true);
                $("#newpassinput").prop("disabled", true);
                $("#confirmpassinput").prop("disabled", true);
            });
            
            
        });
    </script>
</head>

<?php

include ('../connect.php');
include ('../head.php');

$email = $_SESSION['email'];

$sql = "SELECT * FROM user where email= '$email'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //output data of each row
    $row = $result->fetch_assoc();
    $id = $row["userID"]; 

    echo "<body>
        <div class='registration-form'>
        <center><br><h2>My Profile</h2></center>
        <form method='post' action='updateprofile.php'>
        <input type='hidden' name='userID' value='" . $row['userID'] . "'>
        <table class='input-table'>
            <tr>
                <th><label for='firstName'>First Name</label> </th>  
                <td><input type='text' id='firstName' name='firstName' value='" . $row['firstName'] . "' required></td>
            </tr>
            <tr>
                <th><label for='lastName'>Last Name</label> </th>  
                <td><input type='text' id='lastName' name='lastName' value='" . $row['lastName'] . "' required></td>
            </tr>
            <tr>
                <th><label for='email'>Email</label></th> 
                <td><input type='email' id='email' name='email' value='" . $row['email'] . "' required></td>
            </tr>
            <tr>
                <th><label for='contactNo'>Phone Number</label> </th> 
                <td><input type='tel' id='contactNo' name='contactNo' value='" . $row['contactNo'] . "' required></td>
            </tr>
            <tr>
                <th><label for='homeAddress'>Address</label> </th> 
                <td><input type='text' id='homeAddress' name='homeAddress' value='" . $row['homeAddress'] . "' minlength='10' required></td>
            </tr>
            
            <tr>
                <br>
                <td>
                <center>
                <button class='edit-row' id='editButton' type='button'>Edit</button>
                <button class='delete-row' id='cancelButton' type='button'>Cancel</button>
                <button class='edit-row' id='updateButton' type='submit' name='update' value='UPDATE'>Update</button>     
                </center>
                </td>  
            </tr>
        </table>
        </form>
    </div>";

} else {
    echo "0 results";
}

?>

<?php

$sql = "SELECT * FROM user where email= '$email'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //output data of each row
    $row = $result->fetch_assoc();
    $id = $row['userID'];

    echo "
        <div class='registration-form'>
    
        <form method='post' action='updatePass.php'>
        <input type='hidden' name='id' value='$id'>
        <input id='oldpass' type='hidden' name='pass' value='" . $row['password'] . "'>
        <table class='input-table'>
        <tr>
            <th><label id='password'>Password</label></th> 
            <td><input type='password' id='passinput' name='password' value='" . $row['password'] . "' minlength='6' required></td>
        </tr>
        <tr>
            <th><label id='newpasslabel'>New Password</label></th> 
            <td><input type='password' id='newpassinput' name='newpass' minlength='6' required></td>
        </tr>
        <tr>
            <th><label id='confirmpasslabel'>Confirm Password</label></th> 
            <td><input type='password' id='confirmpassinput' name='confirmpass' minlength='6' required></td>
        </tr>
        <tr>
            <td>
                <center>
                <button id='changepass' type='button'>Change Password</button>
                <button class='delete-row' id='cancelChange' type='button'>Cancel</button>
                <button class='edit-row' id='updateChange' type='submit' name='updatechange' value='UPDATE'>Update</button>     
                </center>
            </td>  
        </tr>
    </table>
    </form>
    </div>
</body>";

} else {
    echo "0 results";
}
$conn->close();

include ('../foot.php');
?>