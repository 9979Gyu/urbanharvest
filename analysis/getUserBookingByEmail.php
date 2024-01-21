<?php 
    session_start();

    require("../connect.php");
    require_once("../auth/userProcess.php");
    require_once("../booking/bookingProcess.php");

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_SESSION['email'])){
            $email = $_GET["email"];

            if(isset($email)){
                $user = getUserByEmail($conn, $email, 1);

                if($user != false){
                    $uid = $user["userID"];

                    if(isset($uid)){
                        $booking = getBookingByUid($conn, $uid);
                        
                        if($booking != false){
                            $getBooking = $booking->fetch_all(MYSQLI_ASSOC);
    
                            echo json_encode(['booking' => $getBooking, 'user' => $user]);
                        }
                        else{
                            echo json_encode(['user' => $user]);
                        }
    
                    }
                }
                else{
                    // Error: user not exist
                    echo json_encode(['error' => "User not exist"]);
                }

            }

        }
        else{
            echo "<script>alert('Login required!');</script>";
            session_unset();
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=../auth/login.html\">";
        }
    }
    

    // Close connection
    $conn->close();
?>