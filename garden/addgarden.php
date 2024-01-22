<!DOCTYPE html>
<?php
    session_start();
?>
<html>
    <head>
        <title>Urban Harvest - Add Garden</title>
        <link rel="icon" href="../assets/img/logo.png"/>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#addBtn").click(function(){
                    var name = $("#gardenName").val();
                    var address = $("#gardenAddress").val();
                    
                    if(name == "" || address == ""){
                        window.alert("Please filled in all the fields");
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
        <?php require("../head.php"); ?>
        <section>
            <h1 class="title">New Garden</h1>
            <article>
                <form id="gardenPlot" method="post" action="addprocess.php">
                    <table>
                        <tbody>
                            <tr>
                                <th colspan="2">Garden</th>
                            </tr>
                            <tr>
                                <th>Name:</th>
                                <td>
                                    <input type="text" name="gardenName" id="gardenName" placeholder="garden name" required/>
                                </td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>
                                    <textarea name="gardenAddress" id="gardenAddress" placeholder="garden address" cols="30" rows="5" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="reset" class="submit"><i class="fas fa-eraser"></i> Clear</button>
                                    <button type="submit" class="normal" id="addBtn" name="addBtn">+ Submit</button>
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
