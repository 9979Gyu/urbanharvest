<!DOCTYPE html>
<?php session_start() ?>
<html>
    <head>
        <title>Urban Harvest - Edit Garden Plot</title>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script>
            $(document).ready(function(){
                $("#submitBtn").click(function(){
                    var id = $("#p_id").val();
                    var gid = $("#g_id").val();
                    var size = $("#sizePlot").val();
                    var status= $("input[name='availability']:checked").val();
                    
                    if(size == "" || status == undefined){
                        window.alert("Please filled in all the fields");
                        return false;
                    }
                    else{
                        document.myForm.submit();
                    }
                });

                $("#backBtn").click(function(){
                    var gid = $("#g_id").val();
                    
                    document.myForm.submit();
                });
            });
        </script>
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
                // echo $getSize;
            }
        ?>

        <section>
            <h1 class="title">Edit Garden Plot</h1>
            <article>
                <form id="gardenPlot" method="post" action="plotprocess.php">
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
                                    <input type="hidden" name="g_id" id="g_id" value="<?php echo $getGardenID ?>" required/>
                                    <input type="hidden" name="p_id" id="p_id" value="<?php echo $getID ?>" required/>
                                    <input type="text" name="sizePlot" id="sizePlot" value="<?php echo $getSize; ?>" required/>
                                </td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    <?php 
                                        $sqldata = "SELECT bookApproval FROM booking WHERE plotID = '$getID' ";
                                        $resultdata = mysqli_query($conn, $sqldata);
                                        $getBookStat = null;

                                        if ($resultdata) {
                                            $rowdata = mysqli_fetch_assoc($resultdata);
                                            $getBookStat = isset($rowdata['bookApproval']) ? $rowdata['bookApproval'] : null;
                                        }

                                        if($getAvb == 2) {
                                            if(isset($getBookStat) && $getBookStat == 1) {
                                                echo '
                                                <input type="radio" name="availability" id="availability" value="2" checked required/> Damaged
                                                <input type="radio" name="availability" id="availability" value="0" />Fixed ';
                                            } else {
                                                echo '
                                                <input type="radio" name="availability" id="availability" value="2" checked required/> Damaged
                                                <input type="radio" name="availability" id="availability" value="1" />Fixed ';
                                            }
                                        } else{
                                            if(isset($getBookStat) && $getBookStat == 1) {
                                                echo '
                                                <input type="radio" name="availability" id="availability" value="2" required/> Damaged
                                                <input type="radio" name="availability" id="availability" value="0" checked/>Fixed';
                                            } else {
                                                echo '
                                                <input type="radio" name="availability" id="availability" value="2" required/> Damaged
                                                <input type="radio" name="availability" id="availability" value="1" checked/>Fixed';
                                            }
                                        }
                                    ?>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="normal" id="submitBtn" name="submitBtn" >+ Submit</button>
                                    <button type="submit" class="back" id="backBtn" name="backBtn" >Back</button>
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
