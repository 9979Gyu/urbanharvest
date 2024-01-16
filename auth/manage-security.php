<?php
session_start();

include ('../connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>Manage Security Question</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png"/>
    <link rel="stylesheet" href="../css/admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function(){
            // Hide the input table initially
            $(".input-table").hide();

            // Enable/disable buttons
            $("#newquestion").prop("disabled", false).css({"background-color": "#f28500", "color": "black"});
            $("#questionlist").prop("disabled", true).css({"background-color": "lightgray", "color": "darkgray"});

            // "New Security Question" button click event
            $("#newquestion").click(function () {
                // Show input table, hide display table
                $(".input-table").show();
                $(".display-table").hide();

                // Enable/disable buttons
                $("#newquestion").prop("disabled", true).css({"background-color": "lightgray", "color": "darkgray"});
                $("#questionlist").prop("disabled", false).css({"background-color": "#f28500", "color": "black"});
            });

            // "Security Question List" button click event
            $("#questionlist").click(function () {
                // Show display table, hide input table
                $(".display-table").show();
                $(".input-table").hide();

                // Enable/disable buttons
                $("#newquestion").prop("disabled", false).css({"background-color": "#f28500", "color": "black"});
            $("#questionlist").prop("disabled", true).css({"background-color": "lightgray", "color": "darkgray"});
            });
            
        });

        function generateButtons(questionID) {
            var deleteButton = "<button class='delete-row' onclick='location.href=\"deleteQuest.php?questionID=" + questionID + "\"'>Delete</button>";
            return deleteButton;
        }

    </script>
</head>

<header>
<nav>
    <ul>
        <li><a href='../analysis/dashboard.php'>Home</a></li>
            
                <li><a href='manage-security.php'>Security</a></li>
                    <li><a href=''>User</a>
                        <ul class='innerlist'>
                            <li><a href='../user/admin/admin-custList.php'>Customer</a></li>
                            <li><a href='../user/admin/admin-add-staff.php'>Staff</a></li>
                        </ul>
                    </li>
            
        <li><a href='#'><?php echo $_SESSION['fname'] ?></a>
            <ul class='innerlist'>
                <li><a href='../user/viewprofile.php'><i class='fas fa-user'></i> Profile</a></li>
                <li><a href='../auth/logout.php'><i class='fas fa-sign-out-alt'></i> Logout</a></li>
                <li></li>
            </ul>
        </li>
    </ul>
</nav>
</header>

<?php
echo 
"<body>
    <div class = 'registration-form'>
    <br><center><h2>Security Question Management</h2><br>
        <!-- 'Add new question' button -->
        <button  id='newquestion' class='addstaff'>New Question</button>
        <!-- 'Security question List' button -->
        <button id='questionlist' class='addstaff'>Question List</button>
    </center>

    <table class='input-table'>
    <form method='post' action='addNewQuest.php'>
        <tr>
            <th><label for='sentence'>Question:</label> </th>  
            <td><input type='text' name='sentence' placeholder='Enter the question' required></td>
        </tr>
        <tr>
            <br>
            <td>
            <center>
            <button class='add-row' type='submit' name='SubmitForm'>Add Question</button>
            </center>
            </td>  
        </tr>
    </form>
    </table>

    </div>
</body>"; 

$sql = "SELECT * FROM question WHERE status = 1 ORDER BY questionID ASC;";
$result = $conn->query($sql);
$bil=0;
if ($result->num_rows > 0) {
        echo "<table id='staff-table' class='display-table' border='1'>";
        echo "<thead><tr><th>#</th><th>ID</th><th>QUESTION</th><th>ACTION</th></tr>";

        while ($row = $result->fetch_assoc()) {
            $bil+=1;
            echo "<tr>";
            echo "<td>".$bil."</td>";
            echo "<td>".$row['questionID']."</td>";
            echo "<td>".$row['sentence']."</td>";
    ?>
            <td align="center">
                <?php
                // Call the JavaScript function to generate buttons
                echo "<script>document.write(generateButtons(" . $row['questionID'] . "))</script>";
                ?>
            </td>
    <?php
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<table id='staff-table' class='display-table' border='1'>";
        echo "<thead><tr><th>No.</th><th>ID</th><th>QUESTION</th><th>ACTION</th></tr>";
        echo "<tr>";
        echo "<td></td>";
        echo "<td>No record found</td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "</tr>";
        echo "</table>";
    }
    $conn->close();

include ('../foot.php');
?>
</html>