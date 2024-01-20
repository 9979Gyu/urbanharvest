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

                // Check if a booking already exists for the user and garden
                $existingBooking = getBooking($conn, $uid, 0);

                if (!$existingBooking) {

                    // Add a new booking
                    $result = addBooking($conn, $uid, 0);

                    if($result){
                        echo "<script>alert('Booking created!');</script>";
                        echo "redirecting in 3 seconds...";
                        echo "<meta http-equiv=\"refresh\" content=\"3;URL=index.php\">";
                    }
                    else{
                        echo "<script>alert('Failed to update record!');</script>";
                        echo "redirecting in 3 seconds...";
                        echo "<meta http-equiv=\"refresh\" content=\"3;URL=index.php\">";
                    }
                } else {
                    echo "<script>alert('Booking already exists for this user and garden.');</script>";
                    echo "redirecting in 3 seconds...";
                    echo "<meta http-equiv=\"refresh\" content=\"3;URL=index.php\">";
                }
 
            }
            else{
                echo "<script>alert('Error saving booking record. Please try again.');</script>";
                echo "redirecting in 3 seconds...";
                echo "<meta http-equiv=\"refresh\" content=\"3;URL=index.php\">";
            }

        }
        else{
            // Direct to Login
            echo "<script>alert('Login required!');</script>";
            session_unset();
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=../auth/login.html\">";
        }
    }

    // Close database connection
    $conn->close();

?>