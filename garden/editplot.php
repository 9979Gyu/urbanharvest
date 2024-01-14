<!DOCTYPE html>
<?php session_start() ?>
<html>
    <head>
        <title>Urban Harvest - Edit Garden Plot</title>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- <script>
            $(document).ready(function(){
                // var savedName = localStorage.getItem("gardenName");
                var savedSize = localStorage.getItem("sizePlot");

                // $("#gardenName").val(savedName);
                $("#sizePlot").val(savedSize);
                // document.getElementById("gardenName").innerHTML = savedName;
                document.getElementById("sizePlot").innerHTML = savedSize;

                $("#submitBtn").click(function(){
                    // var name = checkDropDown("#gardenName");
                    var size = $("#sizePlot").val();
                    var status= $("input[name='status']:checked").val();
                    var no = $("#no").val();

                    
                    if(size == "" || status == undefined){
                        window.alert("Please filled in all the fields");
                        return;
                    }
                    else{
                        // localStorage.setItem("gardenName", name);
                        localStorage.setItem("sizePlot", size);
                        localStorage.setItem("status", status);
                        localStorage.setItem("no", no);
                        window.alert("Data has been updated!");
                        window.location.href = "listplot.html"; 
                        return false;
                    }
                });
            });
        </script> -->
    </head>
    <body>
        <?php 
            require("../head.php"); 
            include("../connect.php");

            $getID = $_GET['id'];
            $sql = "SELECT garden.gardenID, name, plotID, size, availability, plot.status 
                    FROM garden JOIN plot ON garden.gardenID = plot.gardenID
                    WHERE plotID = '$getID' ";
            // echo $sql;

            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $getGardenID = $row['gardenID'];
                $getName = $row['name'];
                $getSize = $row['size'];
                $getAvb = $row['availability'];
                $getStatus = $row['status'];
                echo $getSize;
            }
        ?>

        <section>
            <h1 class="title">Edit Garden Plot</h1>
            <article>
                <form id="gardenPlot">
                    <table>
                        <tbody>
                            <tr>
                                <th colspan="2">Plot</th>
                            </tr>
                            <tr>
                                <th>Garden:</th>
                                <td><?php echo $getName ?></td>
                            </tr>
                            <tr>
                                <th>Size:</th>
                                <td>
                                    <input type="text" name="sizePlot" id="sizePlot" value=<?php echo $getSize; ?> required/>
                                </td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    <input type="radio" name="status" id="status" value="Available" required/>Available
                                    <input type="radio" name="status" id="status" value="Fixed"/>Fixed
                                    <input type="radio" name="status" id="status" value="Damaged" />Damaged
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input type="text" name="no" id="no" value="2" hidden/>
                                </td>
                            </tr>
                                <td colspan="2">
                                    <button type="submit" class="normal" id="submitBtn">+ Submit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form> 
            </article>
        </section>
        <?php require("../foot.php"); ?>

    </body>
</html>