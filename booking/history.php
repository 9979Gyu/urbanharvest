<!DOCTYPE html>
<html>
    <?php session_start(); ?>
    <head>
        <title>Urban Harvest-Booking</title>
        <link rel="icon" href="../assets/img/logo.png"/>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/exportScript.js"></script>

        <script>
            $(document).ready(function(){

                $.ajax({
                    url: "getBooking.php",
                    type: "GET",
                    dataType: "json",
                    data: { 
                        isExtend: "all"
                    },
                    success: displayData,
                    error: function(data, status){
                        alert("Data: " + data  + "\nStatus: " + status);
                    }
                });

                function displayData(data){
                    
                    function appendRowsToTable(data){
                        console.log(data.lenth);
                        var dtTable = $('table tbody');
                        dtTable.empty();
                        var newRow;
                        if(data.length > 0){
                            $.each(data, function(index, row){
                                let total = parseInt(row.bookYear) * 50;

                                newRow = '<tr>';

                                newRow = newRow + '<td><input class="indicator" name="indicator" value="' + row.bookingID + '" hidden/>' + (index + 1) + '</td>';

                                newRow = newRow + '<td><span>' + row.name + '</span><br/><span>Plot ' + row.plotID + '</td>' + 
                                    '<td>' + row.address + '</td>' + 
                                    '<td><a href="viewTransaction.php" class="view-details" data-booking-id="' + row.bookingID + '">' + row.bookDateTime + '</a></td>';

                                if(row.bookApproval == 0){
                                    newRow = newRow + '<td><span id="approval">Pending</span></td>';
                                }
                                else if(row.bookApproval == 1){
                                    newRow = newRow + '<td><span id="approval">Approved</span></td>';
                                }
                                else if(row.bookApproval == 2){
                                    newRow = newRow + '<td><span id="approval">Declined</span></td>';
                                }
                                else if(row.bookApproval == 3){
                                    newRow = newRow + '<td><span id="approval">Cancelled</span></td>';
                                }

                                // Display paid amount and amount to pay
                                if(row.paymentStatus == 0){
                                    newRow = newRow + '<td><span>Amount: -</span><br/><span>Paid: -</span></td>' + 
                                    '<td>Pending</td>';
                                }
                                else if(row.paymentStatus == 1){
                                    newRow = newRow + '<td><span>Amount: ' + total + '</span><br/><span>Paid: ' + row.paidAmount + '</span></td>' + 
                                    '<td>Paid</td>';
                                }
                                else if(row.paymentStatus == 3){
                                    newRow = newRow + '<td><span>Amount: -</span><br/><span>Paid: -</span></td>' + 
                                    '<td>Cancelled</td>';
                                }

                                dtTable.append(newRow);
                            });
                        }
                        else{
                            newRow = '<tr><td colspan="8">No record exists</td></tr>';
                            dtTable.append(newRow);
                        } 
                        
                    }

                    appendRowsToTable(data);
                }

                $('table').on('click', 'a.view-details', function (event) {
                    var bookingID = $(this).data('booking-id');

                    // Store the booking ID in a session variable
                    $.ajax({
                        url: 'storeBookingID.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            bookingID: bookingID
                        },
                        success: function (data, status) {
                            // Redirect to the new page
                            window.location.href = "viewTransaction.php";
                        },
                        error: function (data, status) {
                            alert("Error storing booking ID.");
                        }
                    });

                    event.preventDefault();
                });


            });
            
        </script>
    </head>
    <body>
        <?php require("../head.php"); ?>
        <section class="wrapper">
            <h1 class="title">Booking Details History</h1>
            <article class="mainContent">
                <div class="btnGroup">
                    <button id="btnExport" class="normal" type="button">Print PDF</button>
                    <button id="excelBtn" class="submit" type="button">Export Excel</button>
                </div>
                <br>
                <table id="bookingRequest" border="border-collapse">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Garden / Plot No</th>
                            <th>Garden Address</th>
                            <th>Book Date Time</th>
                            <th>Approval</th>
                            <th>Payment (RM)</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr>
                    </tbody>
                </table> 
            </article>
        </section>
        <?php require("../foot.php"); ?>
    </body>
</html>