$(document).ready(function(){

    $("article").hide();
    $(".mainTable").hide();
    $("#bookingRequest").hide();

    $("button[name='search']").click(function(event){

        $email = $("input[name='searchEmail']").val();

        if($email == ""){
            alert("Please fill in user's email address");
            event.preventDefault();
        }
        else{

            $("article").show();

            // get user
            $.ajax({
                url: "getUserBookingByEmail.php",
                type: "GET",
                dataType: "json",
                data: {
                    email: $email,
                },
                success: function(response){
                    $(".message").hide();
                    if ('user' in response) {
                        $(".mainTable").show();
                        displayUserData(response.user);
                    }
                    else{
                        $(".mainTable").hide();
                    }

                    if('booking' in response){
                        $("#bookingRequest").show();
                        displayBookingData(response.booking);
                    }
                    else{
                        $("#bookingRequest").hide();
                    }

                    if('error' in response){
                        $(".message").show();
                        $(".message").text("User not found").css({color: "red"});
                    }
                },
                error: function(error){
                    console.log("Error message: " + error);
                }
            });

            event.preventDefault();
        }

    });

    function displayUserData(response){
        $("#name").html(response.firstName + " " + response.lastName);
        $("#email").html(response.email);
        $("#contact").html(response.contactNo);
        $("#address").html(response.homeAddress);

        if(response.roleID == 1){
            $("#role").html("Admin");
        }
        else if(response.roleID == 2){
            $("#role").html("Staff");
        }
        else if(response.roleID == 3){
            $("#role").html("Customer");
        }
        
    }

    function displayBookingData(response){
        var table = $('#bookingRequest tbody');
        table.empty();
        var index = 1;
        var newRow = "";
        if(response != null){
            // Iterate over each booking
            $.each(response, function(index, row){
                newRow = '<tr>';

                newRow = newRow + '<td><input class="indicator" name="indicator" value="' + row.bookingID + '" hidden/>' + (index + 1) + '</td>';

                newRow = newRow + '<td><span>' + row.name + '</span><br/><span>Plot ' + row.plotID + '</td>' + 
                    '<td>' + row.address + '</td>' + 
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

                table.append(newRow);
            }); 
        }
        else{
            newRow = '<tr><td colspan="9">No record exists</td></tr>';
            table.append(newRow);   
        }
    }
});