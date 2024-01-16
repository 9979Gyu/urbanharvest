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
            else if(isset($_POST['type']) && strtolower($_POST['type']) == 'pay'){

                $bid = $_POST['bid'];
                $paidAmount = $_POST['paidAmount'];
                $result = false;
                if(isset($bid) && isset($paidAmount)){
                    $result = updatePayment($conn, $bid, $paidAmount);
                }

                if($result){
                    echo "Data successfully updated";
                }
                else{
                    echo "Failed to update record!";
                }

            }
            else if(isset($_POST['type']) && strtolower($_POST['type']) == 'delete'){
                $bid = $_POST['bid'];
                $result = false;
                if(isset($bid)){
                    $result = updateBookingStatus($conn, $bid);
                }

                if($result){
                    echo "Data successfully updated";
                }
                else{
                    echo "Failed to update record!";
                }
            }
            // else if(isset($_POST['type']) && strtolower($_POST['type']) == 'extend'){

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