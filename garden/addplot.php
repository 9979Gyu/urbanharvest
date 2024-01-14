<!DOCTYPE html>
<?php session_start() ?>
<html>
    <head>
        <title>Urban Harvest - Add Garden Plot</title>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script>
            $(document).ready(function(){
                $("#addPlotBtn").click(function(){
                    var id = $("#g_id").val();
                    var size = $("#sizePlot").val();
                    
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
            $sql = "SELECT * FROM garden WHERE gardenID = '$getID' ";
            // $sql = "SELECT * FROM garden";

            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $getName = $row['name'];
                $getAddress = $row['address'];
            }

        ?>

        <section>
            <h1 class="title">New Plot</h1>
            <article>
                <form id="gardenPlot" method="post" action="addprocess.php">
                    <table>
                        <tbody>
                            <tr>
                                <th colspan="2">Plot</th>
                            </tr>
                            <tr>
                                <th>Garden:</th>
                                <td>
                                    <select id="gardenName">
                                        <option value="none" disabled selected>--SELECT--</option>
                                        <option value="<?php echo $getName ?>" disabled selected><?php echo $getName ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Size:</th>
                                <td>
                                    <input type="hidden" name="g_id" id="g_id" value="<?php echo $getID ?>" required/>
                                    <input type="text" name="sizePlot" id="sizePlot" placeholder="Plot Size" required/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="normal" id="addPlotBtn" name="addPlotBtn">+ Submit</button>
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