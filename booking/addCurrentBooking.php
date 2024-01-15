<?php 

    session_start();

    require("../connect.php");
    require_once("bookingProcess.php");
    require_once("../auth/userProcess.php");


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_SESSION['email'])){

            if(isset($_POST['submit'])){

                $user = getUserByEmail($conn, $_SESSION["email"], 1);
                $uid = $user["userID"];

                if($uid != null){
                    $result = addBooking($conn, $uid, 0);
                    if($result){
                        echo "<meta http-equiv=\"refresh\" content=\"3;URL=index.php\">";
                    }
                    else{
                        echo "Failed to update record!";
                        echo "<meta http-equiv=\"refresh\" content=\"3;URL=index.php\">";
                    }
                }
                else{
                    echo "Login required!";
                    session_unset();
                    echo "<meta http-equiv=\"refresh\" content=\"3;URL=../auth/login.html\">";
                }
            }
            else{
                echo "Error saving booking record. Please try again";
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