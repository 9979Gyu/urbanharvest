<?php
session_start();
?>

<?php

include ('../../connect.php');
include ('headerStaff.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>Add New Customer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/img/logo.png"/>
    <link rel="stylesheet" href="../../css/staff.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script>
        $(document).ready(function(){
            // Hide the input table initially
            $(".input-table").hide();
            $("#savetable").hide();
            $("#cancelBtn").hide();
            $("#pdf").hide();
            $("#excell").hide();

            // Enable/disable buttons
            $("#addNewCustBtn").prop("disabled", false).css({"background-color": "#f28500", "color": "black"});
            $("#custListBtn").prop("disabled", true).css({"background-color": "lightgray", "color": "darkgray"});

            // "Add new cust" button click event
            $("#addNewCustBtn").click(function () {
                // Show input table, hide display table
                $(".input-table").show();
                $(".display-table").hide();
                $("#downloadBtn").hide();

                // Enable/disable buttons
                $("#addNewCustBtn").prop("disabled", true).css({"background-color": "lightgray", "color": "darkgray"});
                $("#custListBtn").prop("disabled", false).css({"background-color": "#f28500", "color": "black"});
            });

            // "cust List" button click event
            $("#custListBtn").click(function () {
                // Show display table, hide input table
                $(".display-table").show();
                $(".input-table").hide();
                $("#downloadBtn").show();

                // Enable/disable buttons
                $("#addNewCustBtn").prop("disabled", false).css({"background-color": "#f28500", "color": "black"});
                $("#custListBtn").prop("disabled", true).css({"background-color": "lightgray", "color": "darkgray"});
            });

            $("#downloadBtn").click(function () {
                $("#cust-table").hide();
                $("#addNewCustBtn").hide();
                $("#custListBtn").hide();
                $("#savetable").show();
                $("#downloadBtn").hide();
                $("#cancelBtn").show();
                $("#pdf").show();
                $("#excell").show();
            });

            $("#cancelBtn").click(function () {
                $("#cust-table").show();
                $("#addNewCustBtn").show();
                $("#custListBtn").show();
                $("#savetable").hide();
                $("#downloadBtn").show();
                $("#cancelBtn").hide();
                $("#pdf").hide();
                $("#excell").hide();
            });

            $("#excell").click(function () {
                downloadExcel();
            });
        });

            function downloadPDFWithBrowserPrint() {
                window.print();
            }
            document.querySelector('#pdf').addEventListener('click', downloadPDFWithBrowserPrint);
            
            function downloadExcel() {
                var wb = XLSX.utils.book_new();
                wb.SheetNames.push('Customer Data');
                wb.Sheets['Customer Data'] = XLSX.utils.aoa_to_sheet([['No.', 'ID', 'FIRSTNAME', 'LASTNAME', 'EMAIL', 'PHONE', 'ADDRESS']].concat(getTableData()));
                XLSX.writeFile(wb, 'cust-data.xlsx');
                showAlert('Downloading Excel...');
            }

            function getTableData() {
                var data = [];
                $('#savetable tr').each(function () {
                    var row = [];
                    $(this).find('td').each(function () {
                        row.push($(this).text());
                    });
                    data.push(row);
                });
                return data;
            }

            function showAlert(message) {
                alert(message);
            }

    </script>
</head>


<?php
echo 
"<body>
    <div class = 'registration-form'>
    <br><center><h2>Customer Record</h2><br>
        <!-- 'Add new Customer' button -->
        <button  id='addNewCustBtn' class='addcust'>Add New Customer</button>
        <!-- 'cust List' button -->
        <button id='custListBtn' class='addcust'>Customer List</button>
        <!-- 'Download button -->
        <button id='downloadBtn' class='addstaff'>Download</button>
        <!-- 'Cancel button -->
        <button id='cancelBtn' class='delete-row'>Cancel</button><br>
        <!-- 'Download as pdf -->
        <button id='pdf' class='addstaff'>Download PDF</button>
        <!-- 'Download as excell -->
        <button id='excell' class='addstaff'>Download Excell</button>
    </center>

    <table class='input-table'>
    <form method='post' action='addnewCust.php'>
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
            <button class='add-row' type='submit' name='SubmitForm'>Add Customer</button>
            </center>
            </td>  
        </tr>
    </form>
    </table>
    </div>
</body>"; 

$sql = "SELECT * FROM user WHERE roleID = 3 ORDER BY userID ASC;
";
$result = $conn->query($sql);
$num=0;
if($result->num_rows > 0) {
	//output data of each row
    echo "<table id='cust-table' class='display-table' border='1'>";
    echo "<thead><tr><th>No</th><th>ID</th><th>FIRSTNAME</th><th>LASTNAME</th><th>EMAIL</th><th>PHONE</th><th>ADDRESS</th>
    <th>ACTION</th></tr>";
    
    while($row=$result->fetch_assoc()) {
        $num++;
        echo "<tr>";
        echo "<td>".$num."</td>";
        echo "<td>".$row['userID']."</td>";
        echo "<td>".$row['firstName']."</td>";
        echo "<td>".$row['lastName']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['contactNo']."</td>";
        echo "<td>".$row['homeAddress']."</td>";

    ?>
    <td align="center">
    <button class="edit-row" onclick="location.href='updateCust.php?userID=<?php echo $row["userID"]; ?>'">Edit</button>
    <button class="delete-row" onclick="location.href='deleteCust.php?userID=<?php echo $row["userID"]; ?>'">Delete</button>
    </td> 
    <?php
    echo "</tr>";
    }
	echo "</table>";
} else {
    echo "<table id='cust-table' class='display-table' border='1'>";
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

$sql = "SELECT * FROM user WHERE roleID = 3 AND status = 1 ORDER BY userID ASC;";
    $result = $conn->query($sql);
    $num=0;
    if ($result->num_rows > 0) {
        echo "<table id='savetable' class='display-table' border='1'>";
        echo "<thead><tr><th>No.</th><th>ID</th><th>FIRSTNAME</th><th>LASTNAME</th><th>EMAIL</th><th>PHONE</th><th>ADDRESS</th>
        </tr>";

        while ($row = $result->fetch_assoc()) {
            $num+=1;
            echo "<tr>";
            echo "<td>".$num."</td>";
            echo "<td>".$row['userID']."</td>";
            echo "<td>".$row['firstName']."</td>";
            echo "<td>".$row['lastName']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['contactNo']."</td>";
            echo "<td>".$row['homeAddress']."</td>";
            echo "</tr>";
        }
        echo "</table>";
        
    } else {
        echo "<table id='savetable' class='display-table' border='1'>";
        echo "<thead><tr><th>No.</th><th>ID</th><th>FIRSTNAME</th><th>LASTNAME</th><th>EMAIL</th><th>PHONE</th><th>ADDRESS</th>
        </tr>";
        echo "<tr>";
        echo "<td>No record found</td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "</tr>";
        echo "</table>";
    }

$conn->close();
echo "<br>";
include ('../../foot.php');
?>
</html>