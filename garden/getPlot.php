<?php
    session_start();

    require("../connect.php");

    function getPlot($conn, $gardenID){
        $sql = "SELECT * FROM plot WHERE status = 1 AND availability = 1 AND gardenID = '" . $gardenID. "'LIMIT 1";
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

        $gardenID = isset($_GET['gardenID']) ? $_GET['gardenID'] : null;
        
        $plotData = getPlot($conn, $gardenID);

        if($plotData !== false){
            echo json_encode($plotData[0]);
        }
        
    }
    else{
        echo "Login required.";
        session_unset();
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=../auth/login.html\">";
    }
?>