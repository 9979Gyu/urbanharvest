<?php

    require_once("../connect.php");

    $retrieveQuestion = "SELECT * FROM question WHERE status = 1";
    $result = $conn->query($retrieveQuestion);

    if($result){
        // Fetch data 
        $question = $result->fetch_all(MYSQLI_ASSOC);

        if($question !== false){
            echo json_encode($question);
        }
    }
    else {
        return false;
    }

    $conn->close();
?>