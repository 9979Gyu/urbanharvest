<?php
    
    session_start();
    require("../connect.php");
    require_once("bookingProcess.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_SESSION['email'])){
            $result = updateBooking($conn);
            if($result){
                echo "<meta http-equiv=\"refresh\" content=\"3;URL=index.php\">";
            }
            else{
                echo "Failed to update record!";
                echo "<meta http-equiv=\"refresh\" content=\"3;URL=index.php\">";
            }
            
        }
        else{
            // Direct to Login
            echo "Login required!";
            session_unset();
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=../auth/login.html\">";
        }
    }

    // Close database connection
    $conn->close();

?>