<?php
    
    session_start();
    require("../connect.php");
    require_once("bookingProcess.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(isset($_SESSION['email'])){

            $result = false;

            if(isset($_POST['type']) && strtolower($_POST['type']) == "edit"){
                $bid = $_POST['bid'];
                $bookYear = $_POST['bookYear'];
                $result = updateBookYear($conn, $bid, $bookYear);

            }
            else if(isset($_POST['type']) && strtolower($_POST['type']) == 'pay'){

                $bid = $_POST['bid'];
                $paidAmount = $_POST['paidAmount'];
                if(isset($bid) && isset($paidAmount)){
                    $result = updatePayment($conn, $bid, $paidAmount);
                }

            }
            else if(isset($_POST['type']) && strtolower($_POST['type']) == 'delete'){
                $bid = $_POST['bid'];
                $extend = $_POST['extend'];

                if(isset($bid)){
                    $result = updateBookingStatus($conn, $bid, $extend);
                }
            } 
            
            if($result && $_SESSION['role'] == 3){
                // Redirect to another page after successful update
                header("Location: index.php");
                exit();
            }
            else if($_SESSION['role'] != 3){
                echo json_encode(['success' => 'Record updated!']);
            }
            else{
                echo json_encode(['error' => 'Failed to update record!']);
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