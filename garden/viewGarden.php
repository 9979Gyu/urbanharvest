<!DOCTYPE html>
<?php session_start() ?>
<html>
    <head>
        <title>List Garden Details</title>
        <link rel="icon" href="../assets/img/logo.png"/>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
        <script>
            
            function generatePDF() {
                const element = document.getElementById('saveTable');
                const titleDiv = document.createElement('div');
                titleDiv.style.textAlign = 'center';
                titleDiv.style.padding = '10px'; 
                titleDiv.style.fontWeight = 'bold';
                titleDiv.style.fontSize = '18px';
                titleDiv.innerHTML = 'List of Garden Details';

                const container = document.createElement('div');
                container.style.width = '595px'; 
                container.style.height = '842px'; 
                container.style.margin = 'auto'; 
                container.appendChild(titleDiv);
                container.appendChild(element.cloneNode(true));
                html2pdf().from(container).save();
            }
            $(document).ready(function(){
                $("#saveTable").hide();
                $("#saveBtn").hide();
                $("#saveExcBtn").hide();
                $("#cancelBtn").hide();

                $("#dwldBtn").click(function () {
                    $("#table").hide();
                    $("#btn").hide();
                    $("#saveTable").show();
                    $("#dwldBtn").hide();
                    $("#cancelBtn").show();
                    $("#saveBtn").show();
                    $("#saveExcBtn").show();
                });

                $("#cancelBtn").click(function () {
                    window.location.href = "viewGarden.php";
                });

                $("#saveExcBtn").click(function () {
                    downloadExcel();
                    $("#saveTable").hide();
                });

                $("#saveBtn").click(function(){
                    setTimeout(function() {
                        generatePDF();
                    }, 1000);
                });

                function downloadExcel() {
                    var wb = XLSX.utils.book_new();
                    wb.SheetNames.push('List Garden Data');
                    wb.Sheets['List Garden Data'] = XLSX.utils.aoa_to_sheet([['No', 'Garden', 'Address', 'Number Of Plot']].concat(getTableData()));
                    XLSX.writeFile(wb, 'listgarden.xlsx');
                    showAlert('Downloading Excel...');
                    window.location.href = "viewGarden.php";
                }

                function getTableData() {
                    var data = [];
                    $("#saveTable").show();
                    
                    $('#saveTable tr').each(function () {
                        var row = [];
                        $(this).find('td').each(function () {
                            row.push($(this).text());
                        });
                        data.push(row);
                    });
                    return data;
                }

                function showAlert(message) {
                    alert(message);
                }

            });
        </script>

    </head>
    <body>
        <div id="headdiv"> <?php require("../head.php"); ?> </div>
        <?php
            include("../connect.php");
        ?>

        <section class="wrapper" >
            <h1 class="title">Garden Details</h1>

            <article class="mainContent">
                
                <form id="gardenPlot" method="post" action="deleteprocess.php">

                    <section id="btn">
                        <div class="btnGroup">
                            <button type="submit" class="submit" name="addBtn"> + Add</button>
                            <button type="submit" class="delete" name="delBtn"><i class="fas fa-trash-alt"></i> Delete</button>
                        </div>
                        
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
                                $sql = "SELECT * FROM garden";
                                $result = mysqli_query($conn, $sql);
                                $count = 0;
                                while ($row = mysqli_fetch_assoc($result)){

                                        if ($row['status'] == 1) {
                                            $count++;
                                            $gardenID = $row['gardenID'];
                                            $sqlnoplot = "SELECT COUNT(plotID) FROM plot WHERE gardenID = '$gardenID' AND status != 0";
                                            $resultplot = mysqli_query($conn, $sqlnoplot);
                                            $rowplot = mysqli_fetch_assoc($resultplot);
                                            $plotCount = $rowplot['COUNT(plotID)'];
                                            if ($plotCount != 0) {
                                                $sqldata = "SELECT COUNT(plotID) FROM plot WHERE gardenID = '$gardenID' AND (availability != 1 AND status != 0)";
                                                $resultdata = mysqli_query($conn, $sqldata);

                                                if ($resultdata) {
                                                    $rowdata = mysqli_fetch_assoc($resultdata);
                                                    $getdata = $rowdata['COUNT(plotID)'];
                                                    // echo $getdata . "<br>" ;
                                                }
                                                
                                                echo '<tr>';
                                                    if($getdata > 0) {
                                                        echo '<td><input type="checkbox" name="del_cb[]" value="' . $row['gardenID'] . '" disabled/></td>';
                                                    }
                                                    else {
                                                        echo '<td><input type="checkbox" name="del_cb[]" value="' . $row['gardenID'] . '"/></td>';
                                                    }

                                                 echo '       
                                                        <td>' . $count . '</td>
                                                        <td><a href="plot.php?id=' . $row['gardenID'] . '">' . $row['name'] . '</a></td>
                                                        <td>' . $row['address'] . '</td>
                                                        <td>' . $plotCount . '</td>
                                                        <td><a class="submit" href="editgarden.php?id=' . $row['gardenID'] . '" style="background-color: rgb(234,180,100);"><i class="fa fa-edit"></i></a></td>
                                                    </tr>';
                                            } else {
                                                echo '<tr>
                                                    <td><input type="checkbox" name="del_cb[]" value="' . $row['gardenID'] . '"/></td>
                                                    <td>' . $count . '</td>
                                                    <td><a href="plot.php?id=' . $row['gardenID'] . '">' . $row['name'] . '</a></td>
                                                    <td>' . $row['address'] . '</td>
                                                    <td>' . $plotCount . '</td>
                                                    <td><a class="submit" href="editgarden.php?id=' . $row['gardenID'] . '" style="background-color: rgb(234,180,100);"><i class="fa fa-edit"></i></a></td>
                                                </tr>';
                                            }
                                        } else {
                                            echo "";
                                        }
                                } ?>

                        </tbody>
                    </table>
                    <br>
                    <table id="saveTable" border="1">
                        <tbody>
                            <tr class="head">
                                <th>No</th>
                                <th>Garden</th>
                                <th>Address</th>
                                <th>Number of Plot</th>
                            </tr>
                                <?php
                                    $sql = "SELECT * FROM garden";
                                    $result = mysqli_query($conn, $sql);
                                    $count = 0;
                                    while ($row = mysqli_fetch_assoc($result)){

                                        if ($row['status'] == 1) {
                                            $count++;
                                            $gardenID = $row['gardenID'];
                                            $sqlnoplot = "SELECT COUNT(plotID) FROM plot WHERE gardenID = '$gardenID' AND (availability != 0 OR status != 0)";
                                            $resultplot = mysqli_query($conn, $sqlnoplot);
                                            $rowplot = mysqli_fetch_assoc($resultplot);
                                            $plotCount = $rowplot['COUNT(plotID)'];

                                            echo '<tr>
                                                    <td>' . $count . '</td>
                                                    <td><a href="plot.php?id=' . $row['gardenID'] . '" style="text-decoration: none;">' . $row['name'] . '</a></td>
                                                    <td>' . $row['address'] . '</td>
                                                    <td>' . $plotCount . '</td>
                                                </tr>';
                                        } else {
                                            echo "";
                                        }
                                } ?>

                        </tbody>

                    </table>
                </form> 
                <button id='dwldBtn' class="normal"><i class="fa fa-download"></i> Download</button>
                <button id='cancelBtn' class="delete"> Cancel</button>
                <button id='saveBtn' class="normal"> PDF</button>
                <button id='saveExcBtn' class="submit"> Excel</button>
            </article>
        </section>

        <div id="footdiv"> <?php require("../foot.php"); ?> </div>
        

    </body>
</html>
