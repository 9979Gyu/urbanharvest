<?php
    include('../connect.php');
    if(isset($_POST['addBtn'])){
        $nm = $_POST['gardenName'];
        $adrs = $_POST['gardenAddress'];

        $sql = "INSERT garden(name, address, status) VALUES ('$nm', '$adrs', '1')" or die ("Error inserting data into table");

        if ($conn->query($sql) === TRUE){
            echo "<script>alert('New Garden Record added successfully')</script>";
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=viewGarden.php\">";
        } else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }
    if(isset($_POST['addPlotBtn'])){
        $id = $_POST['g_id'];
        $sz = $_POST['sizePlot'];

        $newsql = "INSERT plot(size, availability, status, gardenID) VALUES ('$sz', '1', '-', '$id')" or die ("Error inserting data into table");
        if ($conn->query($newsql) === TRUE){
            echo "<script>alert('New Garden Plot has added successfully')</script>";
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=plot.php?id=". $id ."\">";
        } else {
            echo "Error:" . $newsql . "<br>" . $conn->error;
        }
    }

    $conn->close();
?>