<?php
    
    session_start();

    require("../connect.php");

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
            if(!isset($_SESSION['email'])){
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['role'] = $row["roleID"];
                $_SESSION['fname'] = $row["firstName"];
            }
            
            echo "<meta http-equiv=\"refresh\" content=\"1;URL=../analysis/dashboard.php\">";
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