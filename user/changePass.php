<?php
session_start();

include ('../connect.php');

$checkemail = $_GET['email'];
$password = $_GET['password'];
// Get the email value from the URL parameter
$email = $_GET['email'];

$sql = "SELECT * FROM user WHERE email = '" . $checkemail . "'";

    $result = $conn->query($sql);

    if($result->num_rows == 0){
        echo "User not exist";
        echo "<meta http-equiv=\"refresh\" content=\"2;URL=viewprofile.php\">";
    }
    else{
        
        $row = $result->fetch_assoc();
        $hashedPwd = $row["password"];
        $isHashed = password_verify($password, $row["password"]);

        if($isHashed == 1){
            if(isset($_SESSION['email'])){
                require("../head.php");
            }
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
            <meta charset='utf-8'>
                <title>Manage Security Question</title>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='icon' href='../assets/img/logo.png'/>
                <link rel='stylesheet' href='../css/admin.css' />
                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css' />
                <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js''></script>
                <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>

            </head>

            <body>
                <div class = 'registration-form'>
                <br><center><h2 id='initial'>Change Password</h2>

                </center>

                <form method='post' action='changePassProcess.php'>
                <table class='input-table'>                
            
                    <input type='hidden' name='email' value='$email'>
                    <table>
                        <tr>
                            <td><label>New Password:</label></td>
                            <td>
                            <input type='password' name='newpass' placeholder='Enter new password' minlegth='6' required/>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Confirm Password:</label></td>
                            <td>
                        <input type='password' name='confirmpassword' placeholder='Confirm password' minlegth='6' required/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='2'>
                                <center>
                                    <button class='edit-row' type='submit' name='submit'>Update</button>
                                    <button class='delete-row' onclick='location.href='viewprofile.php''>Cancel</button>
                                </center>
                            </td>
                        </tr>
                    </table>
                </form>

                </div>
            </body> ";

            include ('../foot.php');
            echo "
            </html>";

        }
        else{
            echo "Incorrect password";
            echo "<meta http-equiv=\"refresh\" content=\"2;URL=viewprofile.php\">";

        }
    }
    $conn->close();
?>

