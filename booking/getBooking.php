<?php 
    session_start();

    require("../connect.php");
    require_once("../auth/userProcess.php");
    require_once("bookingProcess.php");

    if($_SESSION['email']){

        // Get uid
        $user = getUserByEmail($conn, $_SESSION['email'], 1);
        $uid = $user["userID"];

        // For staff view
        if(strtolower($_SESSION['role']) == 2){

            $result = getAllBooking($conn);
            if($result){
                $row = $result->fetch_all(MYSQLI_ASSOC);
                echo json_encode($row);
            }
            else{
                echo json_encode(['error' => 'No data found']);
            }

        }
        else{
            // Customer view
            if(isset($uid)){

                if (isset($_GET['isExtend'])) {
                    $isExtend = $_GET['isExtend'];
    
                    $result = getBooking($conn, $uid, $isExtend);
    
                    if($result){
                        // Fetch data
                        $row = $result->fetch_all(MYSQLI_ASSOC);
                        echo json_encode($row);
            
                    }
                    else{
                        echo json_encode(['error' => 'No data found']);
                    }
    
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
    }
    else{
        // Direct to Login
        echo "Login required!";
        session_unset();
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=../auth/login.html\">";
    }

    // Close database connection
    $conn->close();
?>