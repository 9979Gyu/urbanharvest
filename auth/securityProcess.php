<?php
    
    session_start();

    require("../connect.php");
    require_once("userProcess.php");
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // If the security form has been submitted
        if(isset($_POST['submit'])){

            $getUser = getUserByEmail($conn, $_SESSION['email'], 0);

            $getUserID = $getUser["userID"];

            $result = saveSecurityAnswer($conn, $getUserID);

            if($result){
                $updateResult = updateUserStatus($conn, $_SESSION['email'], 1);
                if($updateResult){
                    echo "Security answer saved successfully!";
                    echo "<meta http-equiv=\"refresh\" content=\"3;URL=login.html\">";
                }
            }
            else{
                // Handle the error
                echo "Error saving security answer. Please try again";
                echo "<meta http-equiv=\"refresh\" content=\"3;URL=security.php\">";
            }
        }
    } else {
        // Handle non-POST requests
        echo "Invalid request method";
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=security.php\">";
    }
    
    $conn->close();

?>