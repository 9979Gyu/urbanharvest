<?php
    include('../connect.php');
    if(isset($_POST['delBtn'])){
        if(isset($_POST['del_cb'])){
            $all_id = $_POST['del_cb'];
            //implode - return a string from array
            $extract_id = implode(", ", $all_id);
            // echo $extract_id;
            
            echo "<script>
                    var userConfirmed = confirm('Are you sure to delete all the selected records?');
                    if (userConfirmed) {
                        window.location.href = 'deleteprocess.php?ids=$extract_id';
                    } else {
                        window.location.href = 'viewGarden.php';
                    }
                 </script>";
        } else {
            echo "<script>alert('No records selected! Please select one or more garden records.');</script>";
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=viewGarden.php\">";
        }
    }

    if(isset($_GET['ids'])){
        // Delete records based on IDs if provided in the URL
        $extract_id = $_GET['ids'];
        $sql = "DELETE FROM garden WHERE gardenID IN($extract_id)";
        
        if ($conn->query($sql) === TRUE){
            echo "<script>alert('All selected record(s) deleted successfully');</script>";
        } else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
        
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=viewGarden.php\">";
    }

    if(isset($_POST['addBtn'])){
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=addgarden.php\">";
    }


    $conn->close();
?>