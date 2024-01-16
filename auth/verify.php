<?php
    session_start();
    include('../connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Urban Harvest-Register</title>
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

            $('select[name="question1"]').change(function(){
                var selectedOption = $(this).val();
                
                // Check if the selected option is not the placeholder
                if (selectedOption !== "-select question-") {

                    // Show the answer input for Question 1
                    $('input[name="ans1"]').prop('disabled', false).show();

                } else {
                    // Hide the answer input for Question 1 if no question is selected
                    $('input[name="ans1"]').prop('disabled', true).show();
                }
            });
            
        });
    </script>
</head>
<body>
    <?php include('../connect.php'); ?>
    <div class="regisForm">
        <form action="verifyAccount.php" method="post">
        <input type='hidden' name='email' value='<?php echo $_SESSION['email']; ?>'>
            <table>
                <tr>
                    <th colspan="2"><p class="title">Forgot Password</p></th>
                </tr>
                
                <tr>
                    <td><label>Email</label></td>
                    <td>
                        <input type="email" name="email" placeholder="Enter your email" required/>
                    </td>
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
