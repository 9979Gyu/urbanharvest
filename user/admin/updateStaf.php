<?php
session_start();
include('../../connect.php');

$userID = $_REQUEST['userID'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>Update Staff</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png"/>
    <link rel="stylesheet" href="../../css/admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>


<?php
include('headerAdmin.php');

$sql = "SELECT * FROM user WHERE userID='" . $userID . "'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //output data of each row
    $row = $result->fetch_assoc();
    $id = $row["userID"]; 
    echo "<body>
        <div class='registration-form'>
        <center><br><h2>Edit Staff</h2></center>
        <form method='post' action='updateStaffProcess.php'>
        <input type='hidden' name='userID' value='" . $row['userID'] . "'>
        <table class='input-table'>
            <tr>
                <th><label for='firstName'>First Name</label> </th>  
                <td><input type='text' id='firstName' name='firstName' value='" . $row['firstName'] . "' pattern='[A-Za-z]+' title='Only letters are accepted' required></td>
            </tr>
            <tr>
                <th><label for='lastName'>Last Name</label> </th>  
                <td><input type='text' id='lastName' name='lastName' value='" . $row['lastName'] . "' pattern='[A-Za-z]+' title='Only letters are accepted' required></td>
            </tr>
            <tr>
                <th><label for='email'>Email</label></th> 
                <td><input type='email' id='email' name='email' value='" . $row['email'] . "' required></td>
            </tr>
            <tr>
                <th><label for='contactNo'>Phone Number</label> </th> 
                <td><input type='number' id='contactNo' name='contactNo' value='" . $row['contactNo'] . "' required></td>
            </tr>
            <tr>
                <th><label for='homeAddress'>Address</label> </th> 
                <td><input type='text' id='homeAddress' name='homeAddress' value='" . $row['homeAddress'] . "' minlength='10' required></td>
            </tr>
            <tr>
                <br>
                <td>
                <center>
                <button class='edit-row' type='submit' name='update' value='UPDATE'>Update</button>
                <button class='delete-row' type='cancel' name='cancel'>Cancel</button>
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


include('../../foot.php');
?>