<!DOCTYPE html>
<html>
    <head>
        <title>Urban Harvest-Booking</title>
        <link rel="icon" href="../assets/img/logo.png"/>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="../js/script.js"></script>
        <script>
            $(document).ready(function(){

                sessionStorage.setItem("userType", "Admin");

                var returnedBooking = getBookingList();
                var isExtend = returnedBooking[0];
                var bookingList = returnedBooking[1];
               
                function appendRowsToTable(bookingList){
                    var dtTable = $('table tbody');
                    dtTable.empty();
                    var newRow;

                    if(bookingList.length > 0){
                        $.each(bookingList, function(index, row){
                            newRow = '<tr>';

                            if(isExtend){
                                newRow = newRow + '<td><input id="indicator" value="extend" hidden/>' + (index +1 ) + '</td>';
                            }
                            else{
                                newRow = newRow + '<td><input id="indicator" value="" hidden/>' + (index + 1) + '</td>';
                            }

                            newRow = newRow + '<td><span>' + row[0] + '</span><br/><span>Plot ' + row[1] + '</td>' + 
                                '<td>' + row[2] + '</td>' + 
                                '<td><a href="viewTransaction.html">' + row[3] + '</a></td>' + 
                                '<td>' + row[4] + '</td>' + 
                                '<td>' + row[5] + '</td>' + 
                                '<td><span id="approval">' + row[6] + '</span></td>' +
                                '<td>' + row[7] + '</td>';

                            if(row[6].toUpperCase() === "PENDING"){
                                newRow = newRow + '<td>' +
                                    '<button class="submit" name="approve"><i class="far fa-check-circle"></i></button>' +
                                    '<button class="delete" name="decline"><i class="far fa-times-circle"></i></button>' +
                                    '</td>' +
                                    '</tr>';
                            }
                            else{
                                newRow = newRow + '<td>' + '</td>' + '</tr>';
                            }

                            dtTable.append(newRow);
                        }); 
                    }
                    else{
                        newRow = '<tr><td colspan="9">No record exists</td></tr>';
                        dtTable.append(newRow);
                    }
                }

                $("input[name='selection']").change(function(){
                    if($("input[name='selection']:checked").val().toUpperCase() == "ALL"){
                        appendRowsToTable(bookingList);
                    }
                    else {
                        var filteredList = bookingList.filter(function(row) {
                            return row[6].toUpperCase() === $("input[name='selection']:checked").val().toUpperCase();
                        });
                        appendRowsToTable(filteredList);
                    }

                });

                appendRowsToTable(bookingList);

                $("button[name='approve']").click(function(){
                    var result = window.confirm("Are you sure to approve this booking request?");
                    if(result){
                        if($("#indicator").val() === "extend"){
                            localStorage.setItem("extendApproval", "Approved");
                        }
                        else{
                            localStorage.setItem("bookApproval", "Approved");
                        }
                        window.location.reload();
                    }
                });

                $("button[name='decline']").click(function(){
                    var result = window.confirm("Are you sure to decline this booking request?");
                    if(result){
                        if($("#indicator").val() === "extend"){
                            localStorage.setItem("extendApproval", "Declined");
                        }
                        else{
                            localStorage.setItem("bookApproval", "Declined");
                        }
                        window.location.reload();
                    }
                });
            });
        </script>

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
                <table border="border-collapse">
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!-- <td>1</td>
                            <td>
                                <span>Taman Desa Idaman</span>
                                <span>Plot 2</span>
                            </td>
                            <td>Taman Desa Idaman, Durian Tunggal, 76100, Melaka</td>
                            <td><a href="viewTransaction.html">yuqin1161@gmail.com</a></td>
                            <td>16/10/2023 07:46</td>
                            <td>1</td>
                            <td>
                                <span id="approval">Pending</span>
                            </td>
                            <td>Paid</td>
                            <td>
                                <button class="submit" name="approve"><i class="far fa-check-circle"></i></button>
                                <button class="delete" name="decline"><i class="far fa-times-circle"></i></button>
                            </td> -->
                        </tr>
                    </tbody>
                </table>
            </article>
        </section>
        <footer>
            Copyright &copy; ConnectTheDots | 2023
        </footer>
    </body>
</html>