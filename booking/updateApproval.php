<?php
    
    session_start();
    require("../connect.php");
    require_once("bookingProcess.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(isset($_SESSION['email'])){

            $bid = $_POST['bid'];
            $approval = $_POST['bookApproval'];
            $result = false;

            if(isset($bid) && isset($approval)){
                $result = updateApproval($conn, $bid, $approval);
            }

            if($result){
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