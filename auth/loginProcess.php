<?php
    
    session_start();

    require("../connect.php");
    require_once("../booking/bookingProcess.php");

    $sql = "SELECT * FROM user WHERE email = '" . $_POST['email'] . "'";

    $result = $conn->query($sql);

    if($result->num_rows == 0){
        echo "Login failed";
        session_unset();
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=login.html\">";
    }
    else{
        $row = $result->fetch_assoc();
        $hashedPwd = $row["password"];
        $isHashed = password_verify($_POST['password'], $row["password"]);

        if($isHashed){

            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['role'] = $row["roleID"];
            $_SESSION['fname'] = $row["firstName"];

            // Update booking extend record to current if the current extend is expired
            $result = updateBookingExtend($conn, $row["userID"]);
            echo "<meta http-equiv=\"refresh\" content=\"2;URL=../analysis/dashboard.php\">";
            
        }
        else{
            echo "Login failed";
            session_unset();
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=login.html\">";
        }
    }

    // Close database connection
    $conn->close();
?>