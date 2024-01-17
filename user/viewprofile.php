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

            // Disable the input fields initially
            $("input").prop("disabled", true);

            // Enable input fields and show cancel button when "Edit" is clicked
            $("#editButton").click(function() {
                $("input").prop("disabled", false);
                $(this).hide();
                
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
        });
    </script>
</head>

<?php

include ('../connect.php');
include ('../head.php');

$email = $_SESSION['email'];
$password = $_SESSION['password'];

$sql = "SELECT * FROM user where email= '$email' and password = '$password'";

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
            <th><label for='password'>Password</label></th> 
            <td><input type='password' id='password' name='password' value='" . $row['password'] . "' minlength='6' required></td>
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
        </div>
        </body>";

} else {
    echo "0 results";
}
$conn->close();

include ('../foot.php');
?>