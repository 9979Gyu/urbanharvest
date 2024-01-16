<?php
    session_start();

    require("../connect.php");

    function getPlot($conn){
        $sql = "SELECT * FROM plot WHERE status = 1";
        $result = $conn->query($sql);

        if($result){
            // Fetch data 
            $plotData = $result->fetch_all(MYSQLI_ASSOC);

            return $plotData;
        }
        else {
            return false;
        }
    }

    if(isset($_SESSION['email'])){
        $plotData = getPlot($conn);

        if($plotData !== false){
            echo json_encode($plotData);
        }
        
    }
    else{
        echo "Login required.";
        session_unset();
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=../auth/login.html\">";
    }
?>