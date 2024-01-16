<?php
    session_start();
    if(isset($_SESSION['email'])){
        $_SESSION = array();
        session_destroy();
        echo "<meta http-equiv=\"refresh\" content=\"1;URL=../auth/login.html\">";
    }
    else{
        echo "Failed to logout";
    }
?>