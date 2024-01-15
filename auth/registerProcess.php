<?php

    session_start();

    require("../connect.php");
    require_once('userProcess.php');

    // If the register form has been submitted
    if(isset($_POST['submit'])){
        $result = saveUserData($conn);

        if($result){
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $hashPwd;
            echo "<meta http-equiv=\"refresh\" content=\"2;URL=security.php\">";
        }
        else{
            // Handle the error
            echo "Error: " . $conn->error;
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=register.html\">";
        }
    }
    
    $conn->close();
?>