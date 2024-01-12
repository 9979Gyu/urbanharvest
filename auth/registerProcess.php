<?php

    session_start();

    require("../connect.php");
    require_once('userProcess.php');

    // If the register form has been submitted
    if(isset($_POST['submit'])){
        $result = saveUserData($conn);

        if($result){
            echo "User data saved successfully!";
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=security.php\">";
        }
        else{
            // Handle the error
            echo "Error saving user data. Please try again";
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=register.html\">";
        }
    }
    
    $conn->close();
?>