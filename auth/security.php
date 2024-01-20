<?php
session_start();
include('../connect.php');

// Assuming email is set in the session, modify it if you are passing email differently
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Get userID and roleID based on email from the session
    $getUserInfoQuery = "SELECT userID, roleID FROM user WHERE email = '$email'";
    $result = $conn->query($getUserInfoQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row['userID'];
        $roleID = $row['roleID'];
    } else {
        echo "User not found.";
        echo "<meta http-equiv=\"refresh\" content=\"2;URL=register.html\">";
        exit(); // Exit to prevent further execution if user not found
    }
} else {
    echo "Error";
    echo "<meta http-equiv=\"refresh\" content=\"2;URL=register.html\">";
    exit(); // Exit to prevent further execution if session email is not set
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Set Security Question</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" href="../assets/img/logo.png"/>
    <link rel="stylesheet" href="../css/authStyle.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
            // Initially hide and disable the answer input fields
            $('input[name="ans1"]').prop('disabled', true).show();
            $('input[name="ans2"]').prop('disabled', true).show();

            $('select[name="question1"]').change(function(){
                var selectedOption = $(this).val();
                
                // Check if the selected option is not the placeholder
                if (selectedOption !== "-select question-") {
                    // Disable the selected option in Question 2
                    $('select[name="question2"] option').prop('disabled', false);
                    $('select[name="question2"] option[value="' + selectedOption + '"]').prop('disabled', true);
                    // Show the answer input for Question 1
                    $('input[name="ans1"]').prop('disabled', false).show();

                } else {
                    // Hide the answer input for Question 1 if no question is selected
                    $('input[name="ans1"]').prop('disabled', true).show();
                }
            });
            $('select[name="question2"]').change(function(){
                var selectedOption = $(this).val();
                
                // Check if the selected option is not the placeholder
                if (selectedOption !== "-select question-") {
                    // Disable the selected option in Question 1
                    $('select[name="question1"] option').prop('disabled', false);
                    $('select[name="question1"] option[value="' + selectedOption + '"]').prop('disabled', true);
                    // Show the answer input for Question 2
                    $('input[name="ans2"]').prop('disabled', false).show();
                    
                } else {
                    // Hide the answer input for Question 2 if no question is selected
                    $('input[name="ans1"]').prop('disabled', true).show();
                }
            });
        });
    </script>
</head>
<body>
    <?php include('../connect.php'); ?>
    <div class="regisForm">
        <form action="updateUserStatus.php" method="post">
        <input type='hidden' name='email' value='<?php echo $email; ?>'>
            <table>
                <tr>
                    <th colspan="2"><p class="title">Security Question</p></th>
                </tr>
                <tr>
                    <td><label>Question 1:</label></td>
                    <td>
                        <select name="question1">
                            <?php
                                echo "<option>-select question-</option>";
                                $sql = "SELECT * FROM question WHERE status=1";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()){
                                    echo "<option value='".$row['sentence']."'>".$row['sentence']."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Answer 1:</label></td>
                    <td>
                        <input type="text" name="ans1" placeholder="Enter your answer" required/>
                    </td>
                </tr>
                <tr>
                    <td><label>Question 2:</label></td>
                    <td>
                        <select name="question2">
                            <?php
                                echo "<option>-select question-</option>";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()){
                                    echo "<option value='".$row['sentence']."'>".$row['sentence']."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Answer 2:</label></td>
                    <td>
                        <input type="text" name="ans2" placeholder="Enter your answer" required/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center>
                            <button type="submit" name="submit">Submit</button>
                            <button type="reset" name="reset">Clear</button>
                        </center>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>