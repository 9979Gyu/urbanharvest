<!DOCTYPE html>
<?php session_start() ?>
<html>
    <head>
        <title>Urban Harvest - Edit Garden</title>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script>
            $(document).ready(function(){
                $("#submitBtn").click(function(){
                    var name = $("#gardenName").val();
                    var address = $("#gardenAddress").val();

                    if(name == "" || address == ""){
                        window.alert("Please filled in all the fields");
                        return;
                    }
                    else if(!/^[a-zA-Z\s]+$/.test(name)){
                        window.alert("Please enter valid text input!");
                        return false;
                    }
                    else{
                        document.myForm.submit();
                    }
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
            // echo $getID;

            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $getName = $row['name'];
                $getAddress = $row['address'];
            }
        ?>

        <section>
            <h1 class="title">New Garden</h1>
            <article>
                <form id="gardenPlot" method="post" action="editprocess.php">
                    <table>
                        <tbody>
                            <tr>
                                <th colspan="2">Garden</th>
                            </tr>
                            <tr>
                                <th>Name:</th>
                                <td>
                                    <input type="hidden" name="g_id" id="g_id" value="<?php echo $getID ?>" required/>
                                    <input type="text" name="gardenName" id="gardenName" value="<?php echo $getName ?>" required/>
                                </td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>
                                    <textarea name="gardenAddress" id="gardenAddress" cols="30" rows="5" value="<?php echo $getAddress ?>" required><?php echo $getAddress ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="normal" id="submitBtn" name="edtBtn"> Submit</button>
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