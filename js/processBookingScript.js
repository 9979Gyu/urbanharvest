$(document).ready(function(){

    $.ajax({
        url: "getBooking.php",
        type: "GET",
        dataType: "json",
        success: displayData,
        error: function(data, status){
            alert("Data: " + data  + "\nStatus: " + status);
        }
    });

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

                    if(row.isExtend == 1){
                        newRow = newRow + '<td><span id="isExtend">Extend</span></td>'
                    }
                    else{
                        newRow = newRow + '<td><span id="isExtend">Normal</span></td>'
                    }
                        
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
                    else if(row.bookApproval == 1 && row.paymentStatus == 0){
                        // Assuming row.bookDateTime is a string in the format "YYYY-MM-DD HH:mm:ss"
                        var bookingDateTime = new Date(row.bookDateTime);
                        var currentDate = new Date();

                        // Calculate the difference in days
                        var timeDifference = currentDate - bookingDateTime;
                        var daysDifference = Math.floor(timeDifference / (1000 * 60 * 60 * 24));

                        // If the difference is more than 30 days, show the delete button
                        if (daysDifference > 30) {
                            // Your logic to show the delete button here
                            newRow = newRow + '<td class="no-print">' +
                            '<button class="delete" name="delete"><i class="fas fa-trash-alt"></i></button>' +
                            '</td>' +
                            '</tr>';
                        }
                    }
                    else{
                        newRow = newRow + '<td class="no-print">' + '</td>' + '</tr>';
                    }

                    dtTable.append(newRow);
                }); 
            }
            else{
                newRow = '<tr><td colspan="10">No record exists</td></tr>';
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
                    else if (selectedValue == "UNPAID" && row.paymentStatus == 0) {
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
        var result = window.confirm("Are you sure to approve the booking request?");
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
                success: function(response){
                    alert(response.success);
                    window.location.href = "process.php";
                },
                error: function(data){
                    alert(JSON.stringify(data));
                }
             
            });
            
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
                success: function(response) {
                    alert(response.success);
                    window.location.href = "process.php";
                },
                error: function(data){
                    alert(data);
                }
             
            });
        }
        else{
            event.preventDefault();
        }
    });

    $('table').on('click', 'button[name="delete"]', function (event) {
        var result = window.confirm("Are you sure to remove this booking request? ");
        if(result){

            $extend = $("#isExtend").text().trim().toLowerCase();
            if($extend == "extend"){
                $extend = 1;
            }
            else{
                $extend = 0;
            }

            // Update approval using ajax post method
            $.ajax({
                url: "updateBooking.php",
                type: 'POST',
                dataType: 'json',
                data: {
                    bid: $(this).closest('tr').find('.indicator').val(),
                    type: "delete",
                    extend: $extend,
                },
                success: function(response) {
                    alert(response.success);
                    window.location.href = "process.php";
                },
                error: function(error){
                    alert("Error message: " + error);
                }
             
            });
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
            success: function () {
                // Redirect to the new page
                window.location.href = "viewTransaction.php";
            },
            error: function () {
                alert("Error storing booking ID.");
            }
        });

        event.preventDefault();
    });
});