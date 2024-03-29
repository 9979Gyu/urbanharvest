<?php

    session_start();

    require("../connect.php");
    require_once('userProcess.php');

    // If the register form has been submitted
    if(isset($_POST['submit'])){
        $result = saveUserData($conn);

        if($result['userID'] > 0){

            $_SESSION['email'] = $result['email'];
            $_SESSION['password'] = $result['password'];
            echo "<meta http-equiv=\"refresh\" content=\"1;URL=security.php\">";
        }
        else{
            // Handle the error
            echo "Error: " . $conn->error;
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=register.html\">";
        }
    }
    
    $conn->close();
?>