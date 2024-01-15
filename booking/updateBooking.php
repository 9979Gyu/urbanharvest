<?php
    
    session_start();
    require("../connect.php");
    require_once("bookingProcess.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(isset($_SESSION['email'])){

            if(isset($_POST['type']) && strtolower($_POST['type']) == "edit"){
                $bid = $_POST['bid'];
                $bookYear = $_POST['bookYear'];
                $result = updateBookYear($conn, $bid, $bookYear);

                if($result){
                    echo "Data successfully updated";
                }
                else{
                    echo "Failed to update record!";
                }

            }
            // else if(isset($_POST['type']) && strtolower($_POST['type']) == 'pay'){
            //     // $result = updateBooking($conn);
            //     // if($result){
            //     //     echo "<meta http-equiv=\"refresh\" content=\"3;URL=index.php\">";
            //     // }
            //     // else{
            //     //     echo "Failed to update record!";
            //     //     echo "<meta http-equiv=\"refresh\" content=\"3;URL=index.php\">";
            //     // }
            // }
            // else if(isset($_POST['type']) && strtolower($_POST['type']) == 'delete'){

            // }

            
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