<?php 
    session_start();

    require("../connect.php");
    require_once("../auth/userProcess.php");
    require_once("bookingProcess.php");

    if($_SESSION['email']){

        // Get uid
        $user = getUserByEmail($conn, $_SESSION['email'], 1);
        $uid = $user["userID"];
        $bid = 0;
        if(isset($_SESSION['bid'])){
            $bid = $_SESSION['bid'];
        }

        $result = getBookingById($conn, $bid);
        if($result){
            $row = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($row);
        }
        else{
            echo json_encode(['error' => 'No data found']);
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