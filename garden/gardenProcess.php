<?php
    session_start();

    require("../connect.php");

    function getGarden($conn){
        $sql = "SELECT DISTINCT garden.* FROM garden JOIN plot ON garden.gardenID = plot.gardenID WHERE garden.status = 1 AND plot.status = 1 AND plot.availability = 1";
        $result = $conn->query($sql);

        if($result){
            // Fetch data 
            $gardenData = $result->fetch_all(MYSQLI_ASSOC);

            return $gardenData;
        }
        else {
            return false;
        }
    }

    if(isset($_SESSION['email'])){
        $gardenData = getGarden($conn);

        if($gardenData !== false){
            echo json_encode($gardenData);
        }

    }
    else{
        echo "Login required.";
        session_unset();
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=../auth/login.html\">";
    }
?>