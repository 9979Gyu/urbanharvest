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

            $sql = "SELECT * FROM garden";
            $result = mysqli_query($conn, $sql);

            $count = 0;
            
        ?>

        <section>
            <h1 class="title">Garden Details</h1>

            <article>
                
                <form id="gardenPlot" method="post" action="deleteprocess.php">

                    <section id="btn">
                        <button type="submit" class="delete" name="delBtn"><i class="fas fa-trash-alt"></i> Delete</button>
                        <button type="submit" class="submit" name="addBtn"> + Add</button>
                        <!-- <a class="submit" href="addgarden.html">+ Add</a> -->
                    </section>
                    
                    <table id="table" border="1">
                        <tbody>
                            <tr class="head">
                                <th></th>
                                <th>No</th>
                                <th>Garden</th>
                                <th>Address</th>
                                <th>Number of Plot</th>
                                <th>Action</th>
                            </tr>
                            <?php
                                while ($row = mysqli_fetch_assoc($result)){
                                    $count++
                            ?>
                                <tr>
                                    
                                    <td><input type="checkbox" name="del_cb[]" value="<?php echo $row['gardenID']; ?>"/></td>
                                    <td><?php echo $count; ?></td>
                                    <td><a href="plot.php?id=<?php echo $row['gardenID']; ?>"><?php echo $row['name']; ?></a></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td>3</td>
                                    <td>
                                        <a class="submit" href="editgarden.php?id=<?php echo $row['gardenID']; ?>" style="background-color: rgb(234,180,100);"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                    <br>

                </form> 
            </article>
        </section>

        <?php require("../foot.php"); ?>

    </body>
</html>