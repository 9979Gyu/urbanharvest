<?php
    
    require("../connect.php");
    require_once("userProcess.php");
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // If the security form has been submitted
        if(isset($_POST['submit'])){
            $result = saveSecurityAnswer($conn);

            if($result){
                echo "Security answer saved successfully!";
                echo "<meta http-equiv=\"refresh\" content=\"3;URL=login.html\">";
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