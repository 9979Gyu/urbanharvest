<!DOCTYPE html>
<html>
    <head>
        <?php session_start(); ?>
        <title>Urban Harvest-Booking</title>
        <link rel="icon" href="../assets/img/logo.png"/>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

        <script src="../js/script.js"></script>

        <script>
            $(document).ready(function(){

                $.ajax({
                    url: "getBooking.php",
                    type: "GET",
                    dataType: "json",
                    success: displayData,
                    error: function(data, status){
                        alert("Data: " + data  + "\nStatus: " + status);
                    }
                })

                function displayData(data){
                    
                    function appendRowsToTable(data){
                        var dtTable = $('table tbody');
                        dtTable.empty();
                        var newRow;
                        if(data.length > 0){
                            $.each(data, function(index, row){
                                newRow = '<tr>';

                                newRow = newRow + '<td><input class="indicator" name="indicator" value="' + row.bookingID + '" hidden/>' + (index + 1) + '</td>';

                                newRow = newRow + '<td><span>' + row.name + '</span><br/><span>Plot ' + row.plotID + '</td>' + 
                                    '<td>' + row.address + '</td>' + 
                                    '<td><a href="viewTransaction.php" class="view-details" data-booking-id="' + row.bookingID + '">' + row.email + '</a></td>' + 
                                    '<td>' + row.bookDateTime + '</td>' + 
                                    '<td>' + row.bookYear + '</td>';
                                    
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

                                if(row.paymentStatus == 0){
                                    newRow = newRow + '<td>Pending</td>';
                                }
                                else if(row.paymentStatus == 1){
                                    newRow = newRow + '<td>Paid</td>';
                                }
                                else if(row.paymentStatus == 3){
                                    newRow = newRow + '<td>Cancelled</td>';
                                }

                                if(row.bookApproval == 0){
                                    newRow = newRow + '<td class="no-print">' +
                                        '<button class="submit" name="approve"><i class="far fa-check-circle"></i></button>' +
                                        '<button class="delete" name="decline"><i class="far fa-times-circle"></i></button>' +
                                        '</td>' +
                                        '</tr>';
                                }
                                else{
                                    newRow = newRow + '<td class="no-print">' + '</td>' + '</tr>';
                                }

                                dtTable.append(newRow);
                            }); 
                        }
                        else{
                            newRow = '<tr><td colspan="9">No record exists</td></tr>';
                            dtTable.append(newRow);
                        }
                    }

                    // Return record based on the checked radio text
                    $("input[name='selection']").change(function () {
                        var selectedValue = $("input[name='selection']:checked").val().toUpperCase();

                        var filteredList;

                        if (selectedValue == "ALL") {
                            filteredList = data;
                        } 
                        else {
                            filteredList = data.filter(function (row) {
                                
                                if (selectedValue == "PENDING" && row.bookApproval == 0) {
                                    return true;
                                } 
                                else if (selectedValue == "APPROVED" && row.bookApproval == 1) {
                                    return true;
                                } 
                                else if (selectedValue == "DECLINED" && row.bookApproval == 2) {
                                    return true;
                                }
                                else if (selectedValue == "CANCELLED" && row.bookApproval == 3) {
                                    return true;
                                }
                                return false;
                            });
                        }

                        appendRowsToTable(filteredList);
                    });

                    
                    appendRowsToTable(data);
                }

                $('table').on('click', 'button[name="approve"]', function (event) {
                    var result = window.confirm("Are you sure to approve this booking request?");
                    if (result) {
                        // Update approval using ajax post method
                        $.ajax({
                            url: "updateApproval.php",
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                bid: $(this).closest('tr').find('.indicator').val(),
                                bookApproval: 1,
                            },
                            success: function(data, status) {
                                alert("Data: " + JSON.stringify(data) + "\nStatus: " + status);
                            },
                            error: function(data, status) {
                                alert("Data: " + JSON.stringify(data) + "\nStatus: " + status);
                            }
                         
                        });

                        window.location.reload();
                        
                    } else {
                        event.preventDefault();
                    }
                });

                $('table').on('click', 'button[name="decline"]', function (event) {
                    var result = window.confirm("Are you sure to decline this booking request? ");
                    if(result){
                        // Update approval using ajax post method
                        $.ajax({
                            url: "updateApproval.php",
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                bid: $(this).closest('tr').find('.indicator').val(),
                                bookApproval: 2,
                            },
                            success: function(data, status) {
                                alert("Data: " + JSON.stringify(data) + "\nStatus: " + status);
                            },
                            error: function(data, status) {
                                alert("Data: " + JSON.stringify(data) + "\nStatus: " + status);
                            }
                         
                        });

                        window.location.reload();
                    }
                    else{
                        event.preventDefault();
                    }
                });

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

                // function tableToDataURL(table) {
                //     const svg = new XMLSerializer().serializeToString(table);
                //     const dataURL = 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent(svg);
                //     return dataURL;
                // }

                // $(".mainContent").on("click", "#btnExport", function () {
                //     console.log("ispdf");
                //     // Create a new jsPDF instance
                //     const pdf = new jsPDF();

                //     // Get the HTML content of the table
                //     const table = document.getElementById('bookingRequest');

                //     // Convert the table to a Data URL representation
                //     const dataURL = tableToDataURL(table);

                //     // Add an image of the table to the PDF
                //     pdf.addImage(dataURL, 'PNG', 10, 10, 180, 0);

                //     // Save the PDF
                //     pdf.save('exported-table.pdf');
                //     // html2canvas($('#tblCustomers')[0], {
                //     //     onrendered: function (canvas) {
                //     //         var data = canvas.toDataURL();
                //     //         var docDefinition = {
                //     //             content: [{
                //     //                 image: data,
                //     //                 width: 500
                //     //             }]
                //     //         };
                //     //         pdfMake.createPdf(docDefinition).download("customer-details.pdf");
                //     //     }
                //     // });
                // });

                // $("#example").tableHTMLExport({

                //     type:'pdf',
                //     orientation:'p'
                //     filename: 'bookingRequest.pdf'

                //     // CSS selector(s)
                //     ignoreColumns: '.ignore',
                //     ignoreRows: '.ignore',
                                
                //     // your html table has html content?
                //     htmlContent: false,

                //     // debug
                //     consoleLog: false,        

                // });

                function downloadPDFWithBrowserPrint() {
                    window.print();
                }
                document.querySelector('#btnExport').addEventListener('click', downloadPDFWithBrowserPrint);

                
            });
        </script>

        <style>
            @media print {
                body * {
                    visibility: hidden;
                }

                #bookingRequest,
                #bookingRequest * {
                    visibility: visible;
                }

                #bookingRequest {
                    position: absolute;
                    left: 0;
                    top: 0;
                }

                .no-print {
                    display: none;
                }
            }
        </style>

    </head>
    <body>
        <?php 
            require("../head.php");
        ?>
        <section class="wrapper">
            <h1 class="title">Customer Booking</h1>
            <article class="mainContent">
                <div>
                    <input type="radio" name="selection" value="all" checked/> All
                    <input type="radio" name="selection" value="pending" /> Pending
                    <input type="radio" name="selection" value="approved" /> Approved
                    <input type="radio" name="selection" value="declined" /> Declined
                </div>
                <br/>
                <table id="bookingRequest" border="border-collapse">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Garden / Plot No</th>
                            <th>Garden Address</th>
                            <th>User</th>
                            <th>Book Date Time</th>
                            <th>Use Year</th>
                            <th>Approval</th>
                            <th>Payment Status</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                        </tr>
                    </tbody>
                </table>
                <button id="btnExport" type="button">PDF</button>
            </article>
        </section>
        <footer>
            Copyright &copy; ConnectTheDots | 2023
        </footer>
    </body>
</html>