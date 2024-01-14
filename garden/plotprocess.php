<?php
    include('../connect.php');
    if(isset($_POST['delPlotBtn'])){
        $gid = $_POST['g_id'];
        if(isset($_POST['delplot_cb'])){
            $all_id = $_POST['delplot_cb'];
            //implode - return a string from array
            $extract_id = implode(", ", $all_id);
            // echo $extract_id;
            
            echo "<script>
                    var userConfirmed = confirm('Are you sure to delete all the selected records?');
                    if (userConfirmed) {
                        window.location.href = 'plotprocess.php?ids=$extract_id&g_id=$gid';
                    } else {
                        window.location.href = 'plot.php?id=". $gid ." ';
                    }
                 </script>";
        } else {
            echo "<script>alert('No records selected! Please select one or more garden records.');</script>";
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=plot.php?id=". $gid ."\">";
        }
    }

    if(isset($_GET['ids'])){
        $extract_id = $_GET['ids'];
        $gid = $_GET['g_id'];

        $sql = "UPDATE plot SET availability=0, status=0 WHERE plotID IN($extract_id)";
        
        if ($conn->query($sql) === TRUE){
            echo "<script>alert('All selected plot record(s) deleted successfully');</script>";
        } else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=plot.php?id=". $gid ."\">";
        
    }

    if(isset($_POST['addPlotBtn'])){
        $gid = $_POST['g_id'];
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=addplot.php?id=". $gid ."\">";
    }

    if(isset($_POST['submitBtn'])){
        $id = $_POST['p_id'];
        $gid = $_POST['g_id'];
        $sz = $_POST['sizePlot'];
        $stat = $_POST['status'];

        $sql = "UPDATE plot SET size='$sz', status='$stat' WHERE plotID = '$id'";

        if ($conn->query($sql) === TRUE){
            echo "<script>alert('Garden Plot Record updated successfully')</script>";
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=plot.php?id=". $gid ."\">";
        } else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }

    if(isset($_POST['backBtn'])){
        $gid = $_POST['g_id'];
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=plot.php?id=". $gid ."\">";
    }


    $conn->close();
?>