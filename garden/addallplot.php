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

            $sql = "SELECT * FROM garden ";
            // $sql = "SELECT * FROM garden";

            $result = mysqli_query($conn, $sql);

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
                                        <?php
                                            $sql = "SELECT * FROM service";
                                            $result = mysqli_query($db, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $getID = $row['gardenID'];
                                                $getName = $row['name'];
                                                $getAddress = $row['address'];

                                        ?>
                                            <option name="gardenName" value="<?php echo $getID; ?>"><?php echo $getName; ?></option>

                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Size:</th>
                                <td>
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