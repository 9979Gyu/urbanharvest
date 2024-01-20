<?php
    session_start();
    require("../connect.php");
    require_once("bookingProcess.php");
    require_once("../auth/userProcess.php");
 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_SESSION['email'])){
            $result = false;
            $user = getUserByEmail($conn, $_SESSION["email"], 1);
            $uid = $user["userID"];

            if($uid != null){

                // get the last booking date time
                $sqlBookDt = "SELECT bookDateTime, bookYear FROM booking WHERE userID = '" . $uid . "' AND isExtend = 0 AND bookApproval = 1 ORDER BY bookDateTime DESC LIMIT 1";
                $getDT = $conn->query($sqlBookDt);
                $bookDT = $getDT->fetch_assoc();
                $useYear = $bookDT['bookYear'];
                $bookDT = $bookDT['bookDateTime'];
                $now = getCurrentDTByTimezone();

                // Creates DateTime objects
                $bookDT = strtotime($bookDT);
                $now = strtotime($now);

                $target = (365 * $useYear) - 8;

                // Calculates the difference between DateTime objects
                $diff = ($now - $bookDT)/60/60/24;

                if($diff >= $target){
                    $result = addExtendBooking($conn, $uid, 1); 
                    
                    if($result){
                        echo "<meta http-equiv=\"refresh\" content=\"3;URL=viewExtend.php\">";
                    }
                    else{
                        echo "Failed to update record!";
                        echo "<meta http-equiv=\"refresh\" content=\"3;URL=index.php\">";
                    }
                }
                else{
                    echo "<script>alert('Sorry you can only extend booking a week before booking expired!');</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php\">";
                }
                
            }
            else{
                echo "Login required!";
                session_unset();
                echo "<meta http-equiv=\"refresh\" content=\"3;URL=../auth/login.html\">";
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