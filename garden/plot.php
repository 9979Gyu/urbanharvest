<!DOCTYPE html>
<?php session_start() ?>
<html>
    <head>
        <title>List Garden Details</title>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    </head>
    <body>
        <?php 
            require("../head.php"); 
            include("../connect.php");

            $getID = $_GET['id'];
            $count = 0;
            $status_avb = "";
            $status2 = "";

            $sql = "SELECT * FROM garden WHERE gardenID = '$getID' ";
            // echo $getID;

            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $getGardenID = $row['gardenID'];
                $getName = $row['name'];
                $getAddress = $row['address'];
            }

            $sql2 = "SELECT * FROM plot WHERE gardenID = '$getID'";
            $result2 = mysqli_query($conn, $sql2);

            if(mysqli_num_rows($result2) == 0) {
                echo "<section><h1 class='title'>" . $getName. "</h1></section>";
                echo "<p id='new'>0 plot(s) for this garden. You can add <a href='addplot.php?id=".$getID."'>here</a></p><br>";
            } else {

        ?>
            

        <section>
            <h1 class="title"><?php echo $getName; ?></h1>
            
            <article>
                
                <form id="gardenPlot" method="post" action="plotprocess.php">
                <section id="btn">
                    <button type="submit" class="delete" name="delPlotBtn"><i class="fas fa-trash-alt" ></i> Delete</button>
                    <button type="submit" class="submit" name="addPlotBtn"> + Add</button>
                </section>
                    
                    <table id="table" border="1">
                        <tbody>
                            <tr class="head">
                                <th></th>
                                <th>No</th>
                                <!-- <th>Plot</th> -->
                                <th>Size</th>
                                <th>Availability</th>
                                <th>Action</th>
                            </tr>
                            <?php
                                $count = 0;
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    // $count++;
                                    $pid = $row2['plotID'];
                                    $psize = $row2['size'];
                                    $pavailability = $row2['availability'];
                                    $pstatus = $row2['status'];

                                    if ($pavailability == 1) {
                                        $status_avb = "Available";
                                    } elseif ($pavailability == 0) {
                                        $status_avb = "Booked";
                                    } elseif ($pavailability == 2) {
                                        $status_avb = "Damaged";
                                    }

                                    if ($pstatus == 0) {
                                        $status2 = "Damaged";
                                    } elseif ($pstatus == 1) {
                                        $status2 = "Fixed";
                                    }


                                    if ($pstatus == 0) {
                                        echo "";
                                        
                                    } else {
                                        $count++;
                                        echo '<tr>
                                                <td>
                                                    <input type="checkbox" name="delplot_cb[]" value="' . $pid . '"/>
                                                    <input type="hidden" name="g_id" value="' . $getGardenID . '"/>
                                                </td>
                                                <td>' . $count . '</td>
                                                <td>' . $psize . '</td>
                                                <td>' . $status_avb . '</td>
                                                <td><a class="submit" href="editplot.php?id=' . $pid . '" style="background-color: rgb(234,180,100);"><i class="fa fa-edit"></i></a></td>
                                              </tr>';
                                    }
                                    ?>
                        <?php   } ?>
                            
                        </tbody>
                    </table>
                    <br>

                </form> 
            </article>
        </section>

        <?php } ?>

        <?php require("../foot.php"); ?>

    </body>
</html>