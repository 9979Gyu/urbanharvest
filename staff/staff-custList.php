<?php
session_start();

include('../../connect.php');
include('headerStaff.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Customer List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/img/logo.png"/>
    <link rel="stylesheet" href="../../css/admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
</head>

<body>


    <div class='registration-form'>
        <br><center><h2>Customer Record</h2><br>
        </center>
    </div>

    <?php
    $sql = "SELECT * FROM user WHERE roleID = 3 AND status = 1 ORDER BY userID ASC";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        echo "<table id='display-table' class='display-table' border='1'>";
        echo "<thead><tr><th>ID</th><th>FIRSTNAME</th><th>LASTNAME</th><th>EMAIL</th><th>PHONE</th><th>ADDRESS</th>
        <th>ACTION</th></tr>";

        while($row=$result->fetch_assoc()) {
            echo "<tr>";
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
        echo "<table id='display-table' class='display-table' border='1'>";

        echo "<thead><tr><th>ID</th><th>FIRSTNAME</th><th>LASTNAME</th><th>EMAIL</th><th>PHONE</th><th>ADDRESS</th>
        </tr>";
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
</body>
</html>
