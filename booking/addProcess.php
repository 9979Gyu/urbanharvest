<?php 

    session_start();

    require("../connect.php");
    require_once("../auth/userProcess.php");

    if(isset($_SESSION['email'])){

        if(isset($_POST['submit'])){

            $currentDT = date('Y-m-d H:i:s');

            $garden = $_POST['gardenName'];
            $plotNo = $_POST['plotNo'];
            $bookYear = $_POST['bookYear'];

            $user = getUserByEmail($conn, $_SESSION['email'], 1);
            $userID = $user["userID"];

            if(isset($garden) && isset($plotNo) && isset($bookYear)){
                $insertBooking = "INSERT INTO booking (bookDateTime, paymentStatus, bookYear, bookApproval, status, plotID, userID) VALUES
                ('" . $currentDT . "', " . 0 . ", '" . $bookYear . "', " . 0 . ", " . 1 . ", '" . $plotNo . "', '" . $userID . "')" or
                die("Error inserting new record");

                if($conn->query($insertBooking)){
                    echo "Booking record saved successfully!";
                    echo "<meta http-equiv=\"refresh\" content=\"3;URL=index.php\">";
                }
                else{
                    echo "Error saving booking record. Please try again";
                    echo "<meta http-equiv=\"refresh\" content=\"3;URL=add.php\">";
                }
            }
            else{
                echo "Error saving booking record. Please try again";
                echo "<meta http-equiv=\"refresh\" content=\"3;URL=index.php\">";
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

?>