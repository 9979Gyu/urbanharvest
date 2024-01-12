<?php 
    session_start();

    require("../connect.php");
    require_once("../auth/userProcess.php");

    if($_SESSION['email']){

        // Get uid
        $user = getUserByEmail($conn, $_SESSION['email'], 1);
        $uid = $user['userID'];

        $getBooking = "SELECT * FROM booking WHERE userID = '" . $uid . "' ORDER BY bookDateTime DESC";

        $result = $conn->query($getBooking);

        if($result->num_rows > 0){
            // Fetch data
            $row = $result->fetch_all(MYSQLI_ASSOC);

        }
        else{
            echo "No record";
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=add.php\">";
        }

    }
    else{
        // Direct to Login
        echo "Login required!";
        session_unset();
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=../auth/login.html\">";
    }
?>