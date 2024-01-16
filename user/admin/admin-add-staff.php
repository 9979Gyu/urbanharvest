<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>Add New Staff</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png"/>
    <link rel="stylesheet" href="../../css/admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function(){
            // Hide the input table initially
            $(".input-table").hide();

            // Enable/disable buttons
            $("#addNewStaffBtn").prop("disabled", false).css({"background-color": "#f28500", "color": "black"});
            $("#staffListBtn").prop("disabled", true).css({"background-color": "lightgray", "color": "darkgray"});

            // "Add new staff" button click event
            $("#addNewStaffBtn").click(function () {
                // Show input table, hide display table
                $(".input-table").show();
                $(".display-table").hide();

                // Enable/disable buttons
                $("#addNewStaffBtn").prop("disabled", true).css({"background-color": "lightgray", "color": "darkgray"});
                $("#staffListBtn").prop("disabled", false).css({"background-color": "#f28500", "color": "black"});
            });

            // "staff List" button click event
            $("#staffListBtn").click(function () {
                // Show display table, hide input table
                $(".display-table").show();
                $(".input-table").hide();

                // Enable/disable buttons
                $("#addNewStaffBtn").prop("disabled", false).css({"background-color": "#f28500", "color": "black"});
            $("#staffListBtn").prop("disabled", true).css({"background-color": "lightgray", "color": "darkgray"});
            });
            
        });

        function generateButtons(userID, status) {
            var editButton = "<button class='edit-row' onclick='location.href=\"updateStaf.php?userID=" + userID + "\"'>Edit</button>";
            var deactivateButton = "<button class='delete-row' onclick='location.href=\"deactivateStaff.php?userID=" + userID + "\"'>Deactivate</button>";
            var activateButton = "<button class='edit-row' onclick='location.href=\"activateStaff.php?userID=" + userID + "\"'>Activate</button>";

            // Check the status and generate the appropriate buttons
            if (status == 1) {
                return editButton + deactivateButton;
            } else {
                return activateButton;
            }
        }
    </script>
</head>
<?php

session_start();

include ('../../connect.php');
include('headerAdmin.php');

echo 
"<body>
    <div class = 'registration-form'>
    <br><center><h2>Staff Record</h2><br>
        <!-- 'Add new staff' button -->
        <button  id='addNewStaffBtn' class='addstaff'>Add New Staff</button>
        <!-- 'staff List' button -->
        <button id='staffListBtn' class='addstaff'>Staff List</button>
    </center>

    <table class='input-table'>
    <form method='post' action='addnewStaff.php'>
        <tr>
            <th><label for='firstName'>First Name</label> </th>  
            <td><input type='text' id='firstName' name='firstName' placeholder='First Name' required></td>
        </tr>
        <tr>
            <th><label for='lastName'>Last Name</label> </th>  
            <td><input type='text' id='lastName' name='lastName' placeholder='Last Name' required></td>
        </tr>
        <tr>
            <th><label for='email'>Email</label></th> 
            <td><input type='email' id='email' name='email' placeholder='Enter Email' required></td>
        </tr>
        <tr>
            <th><label for='contactNo'>Phone Number</label> </th> 
            <td><input type='tel' id='contactNo' name='contactNo' placeholder='Enter Phone Number' required></td>
        </tr>
        <tr>
            <th><label for='homeAddress'>Address</label> </th> 
            <td><textarea type='text' id='homeAddress' name='homeAddress' placeholder='Street, city, state' 
            cols='80' rows='3' minlength='10' required></textarea></td>
        </tr>
        <tr>
            <th><label for='password'>Password</label></th> 
            <td><input type='password' id='password' name='password' placeholder='Enter Password' required></td>
        </tr>
        <tr>
            <th><label for='confirmpassword'>Confirm Password</label></th> 
            <td><input type='password' id='confirmpassword' name='confirmpassword' placeholder='Confirm Password' required></td>
        </tr>
        <tr>
            <br>
            <td>
            <center>
            <button class='add-row' type='submit' name='SubmitForm'>Add Staff</button>
            </center>
            </td>  
        </tr>
    </form>
    </table>

    </div>
</body>"; 

$sql = "SELECT * FROM user WHERE roleID = 2 AND status = 1 ORDER BY userID ASC;
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
        echo "<table id='staff-table' class='display-table' border='1'>";
        echo "<thead><tr><th>ID</th><th>FIRSTNAME</th><th>LASTNAME</th><th>EMAIL</th><th>PHONE</th><th>ADDRESS</th>
        <th>ACTION</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['userID']."</td>";
            echo "<td>".$row['firstName']."</td>";
            echo "<td>".$row['lastName']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['contactNo']."</td>";
            echo "<td>".$row['homeAddress']."</td>";
    ?>
            <td align="center">
                <button class="edit-row" onclick="location.href='updateStaf.php?userID=<?php echo $row["userID"]; ?>'">Edit</button>
                <button class="delete-row" onclick="location.href='deleteStaff.php?userID=<?php echo $row["userID"]; ?>'">Delete</button>
            </td>
    <?php
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<table id='staff-table' class='display-table' border='1'>";
        echo "<thead><tr><th>ID</th><th>FIRSTNAME</th><th>LASTNAME</th><th>EMAIL</th><th>PHONE</th>
        <th>ACTION</th></tr>";
        echo "<tr>";
        echo "<td>No record found</td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "</tr>";
        echo "</table>";
    }
    $conn->close();

include ('../../foot.php');
?>
</html>