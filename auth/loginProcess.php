<?php
    
    session_start();

    if(!isset($_SESSION['email'])){
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
    }

    require("../connect.php");

    $sql = "SELECT * FROM user WHERE 
        email = '" . $_SESSION['email'] . "' AND 
        password = '" . $_SESSION['password'] . "'";

    $result = $conn->query($sql);

    if($result->num_rows == 0){
        echo "Login failed";
        session_unset();
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=login.html\">";
    }
    else{
        while ($row = $result->fetch_assoc()) {
            if ($row['status'] == 0) {
                // Redirect to security.php if status is 0
                echo "<meta http-equiv=\"refresh\" content=\"0;URL=security.php\">";
            } else {
                $_SESSION['role'] = $row["roleID"];
                $_SESSION['fname'] = $row["firstName"];
                echo "<meta http-equiv=\"refresh\" content=\"1;URL=../analysis/dashboard.php\">";
            }
        }
    }

    // Close database connection
    $conn->close();
?>