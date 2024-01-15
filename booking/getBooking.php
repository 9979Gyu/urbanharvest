<?php 
    session_start();

    require("../connect.php");
    require_once("../auth/userProcess.php");

    if($_SESSION['email']){

        // Get uid
        $user = getUserByEmail($conn, $_SESSION['email'], 1);
        $uid = $user["userID"];

        if(isset($uid)){
            $getBooking = "SELECT * FROM booking 
            JOIN plot
            ON plot.plotID = booking.plotID
            JOIN garden 
            ON garden.gardenID = plot.gardenID
            WHERE userID = '" . $uid . "' 
            ORDER BY bookDateTime DESC
            LIMIT 1";
    
            $result = $conn->query($getBooking);
    
            if($result->num_rows > 0){
                // Fetch data
                $row = $result->fetch_all(MYSQLI_ASSOC);
                echo json_encode($row);
    
            }
            else{
                return false;
            }
        }
        else{
            return false;
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