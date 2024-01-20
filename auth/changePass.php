<!DOCTYPE html>
<html>
    <head>
        <title>Urban Harvest-Change Password</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="icon" href="../assets/img/logo.png"/>
        <link rel="stylesheet" href="../css/authStyle.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="regisForm">
            <form action="changePassProcess.php" method="post">
                <?php
                    // Retrieve the email parameter from the URL
                    $email = isset($_GET['email']) ? $_GET['email'] : '';
                ?>
            <button class="back" onclick="location.href='login.html'">Back</button>
            <input type='hidden' name='email' value='<?php echo $email; ?>'>
                <table>
                    <tr>
                        <th colspan="2"><p class="title">Change Password</p></th>
                    </tr>
                    
                    <tr>
                        <td><label>New Password:</label></td>
                        <td>
                            <input type="password" name="password" placeholder="Enter password" required/>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Confirm Password:</label></td>
                        <td>
                            <input type="password" name="confirmpassword" placeholder="Enter password" required/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <center>
                                <button type="submit" name="submit">Proceed</button>
                                <button type="reset" name="reset">Clear</button>
                            </center>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>