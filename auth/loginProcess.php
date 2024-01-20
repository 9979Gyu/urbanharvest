<?php
    
    session_start();

    if(!isset($_SESSION['email'])){
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
    }

    require("../connect.php");
    require_once("../booking/bookingProcess.php");

    $sql = "SELECT * FROM user WHERE email = '" . $_POST['email'] . "'";

    $result = $conn->query($sql);

    if($result->num_rows == 0){
        echo "User not exist";
        session_unset();
        echo "<meta http-equiv=\"refresh\" content=\"2;URL=login.html\">";
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
            $email= $_SESSION['email'];
            // Check if the userID exists in the answer table
            $answerCheckSql = "SELECT * FROM answer WHERE userID = '" . $row['userID'] . "'";
            $answerCheckResult = $conn->query($answerCheckSql);

            if ($answerCheckResult->num_rows > 0) {
                // Update booking extend record to current if the current extend is expired
                $result = updateBookingExtend($conn, $row["userID"]);
                echo "<meta http-equiv=\"refresh\" content=\"1;URL=../analysis/dashboard.php\">";
            } else {
                echo "<script>alert('Set your security question and answer first');</script>";
                echo "<meta http-equiv=\"refresh\" content=\"0;URL=security.php?email=$email\">";
            }
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