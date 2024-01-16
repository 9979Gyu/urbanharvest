<?php
    include('../connect.php');
    if(isset($_POST['edtBtn'])){
        $id = $_POST['g_id'];
        $name = $_POST['gardenName'];
        $address = $_POST['gardenAddress'];

        $sql = "UPDATE garden SET name='$name', address='$address' WHERE gardenID = '$id'";

        if ($conn->query($sql) === TRUE){
            echo "<script>alert('Garden Record updated successfully')</script>";
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=viewGarden.php\">";
        } else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
?>