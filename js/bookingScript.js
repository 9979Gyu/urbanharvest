$(document).ready(function () {

    var savedID = "";
    var savedName = "";
    var savedPlot = "";
    var savedAddress = "";
    var savedBookApproval = "";
    var savedBookDT = "";
    var savedYear = "";
    var savedBookExpired = "";
    var savedPayStatus = "";
    var savedPaid = "";
    var savedPayDT = "";
    var extended = 0;

    
    // Make an AJAX request to retrieve data
    $.ajax({
        url: 'getBooking.php',
        type: 'GET',
        dataType: 'json',
        data: {
            isExtend: $("input[name='isExtend']").val()
        },
        success: handleData,
        error: handleData
    });

    // Function to handle the data and execute additional logic
    function handleData(data) {
        console.log(data);
        if (data !== false) {
            $("#gardenName option").remove();
            $.each(data, function (index, booking) {
                if(booking.isExtend == $("input[name='isExtend']").val()){
                    extended = booking.isExtend;
                    if (savedID == "") {
                    
                        $("input[name='bookYear']").prop('disabled', false);
                        $("input[name='bookID']").val(booking.bookingID);
                        savedID = booking.gardenID;
                        savedName = booking.name;
                        savedPlot = booking.plotID;
                        savedAddress = booking.address;
                        savedBookApproval = booking.bookApproval;
                        savedBookDT = booking.bookDateTime;
                        savedYear = booking.bookYear;
                        savedPayStatus = booking.paymentStatus;
                        savedPaid = booking.paidAmount;
                        savedPayDT = booking.paymentDateTime;
                    }
                }

            });
            
            // Check if there is saved data
            if (savedName && savedPlot && savedAddress && savedYear && savedBookDT) {
                // Set value
                var option = $('<option>').val(savedID).text(savedName).prop("selected", true);
                $("#gardenName").append(option).val(savedID);

                $("input[name='plotNo']").val(savedPlot);
                $("textarea[name='gardenAddress']").val(savedAddress);
                $("input[name='bookDT']").val(savedBookDT);
                $("input[name='bookYear'][value='" + savedYear + "']").prop("checked", true);

                if(savedBookDT != ""){
                    bookYear = $("input[name='bookYear']:checked").val();
                    
                    // approval
                    if(savedBookApproval == 0){
                        $("span:eq(0)").html("Pending");
                    }
                    else if(savedBookApproval == 1){
                        $("span:eq(0)").html("Approved");
                    }
                    else{
                        $("span:eq(0)").html("Declined");
                    }
                    
                    // payment status
                    if(savedPayStatus == 0){
                        $("span:eq(1)").html("Pending");
                    }
                    else if(savedPayStatus == 1){
                        $("span:eq(1)").html("Paid");
                        $("input[name='payAmount']").val(savedPaid);
                        let balance = savedPaid - (savedYear * 50);
                        $("input[name='balance']").val(balance);
                        $("input[name='payDT']").val(savedPayDT);
                    }
                    else{
                        $("span:eq(1)").html("Cancelled");
                    }
                    
                    savedBookExpired = getExpiredDate(savedBookDT, true,  bookYear);
                    if(savedBookExpired != null){
                        $("input[name='bookExpired']").val(savedBookExpired);
                    }

                    // total amount to paid
                    $("span:eq(2)").html(parseInt(savedYear) * 50);
                }
            } 
            else {
                console.log("HERE");

                // Handle the case where there is no booking data
                $(".mainContent").hide();
                $(".message").html("No booking record exists. You can book <a href='add.php'>here</a>.").css("color", "Red");
            }

            if($("span:eq(0)").html().toUpperCase() === "DECLINED"){
                $(".paySection").hide();
            }

        }

        buttonControl();
    }

    if($("input[name='bookExpired']") != null){
        $("input[name='plotNo']").prop('readonly', true);
        $("textarea[name='gardenAddress']").prop('readonly', true);
        $("input[name='bookDT']").prop('readonly', true);
        $("input[name='bookExpired']").prop('readonly', true);
        $("input[name='balance']").prop('readonly', true);
        $("input[name='payDT']").prop('readonly', true);
    }


    function buttonControl(){

        console.log(extended);
        $("button[name='extend']").hide();
        $("button[name='pay']").hide();
        $("button[name='edit']").hide();
        $(".amount").hide();

        if($("span:eq(0)").html().toUpperCase() == "PENDING"){
            $("button[name='edit']").show();
        }
        else if($("span:eq(0)").html().toUpperCase() == "APPROVED" && 
            $("span:eq(1)").html().toUpperCase() == "PENDING"){
            $("button[name='pay']").show();
            $(".amount").show();
            $("input[name='bookYear']").prop('disabled', true);
        }
        else if($("span:eq(1)").html().toUpperCase() == "PAID" && extended == 0){
            $("button[name='extend']").show();
            $(".amount").show();
            $("input[name='bookYear']").prop('disabled', true);
        }
    }
    
    // If button pay clicked, 
    // check if input is valid, 
    // else display error message and return
    $("button[name='pay']").click(function (event) {
        var amount = parseFloat($("input[name='payAmount']").val());
        $("input[name='status']").val(1);
        if (isNaN(amount)) {
            console.log("is here");
            $(".message").html("Please enter numbers only");
            scrollToMessage();
            $("input[name='payAmount']").focus();
            event.preventDefault();
        } 
        else if (amount >= 50 * savedYear) {
            // Calculate balance
            var balance = amount - 50 * savedYear;

            // Get current DateTime
            var payDT = getDate(false, 0);

            alert("Thank you for booking the place.");
            $("input[name='balance']").val(balance);
            $("input[name='payDT']").val(payDT);
            $("span:eq(1)").html("Paid");
            $(".message").hide();

            buttonControl();

            $.ajax({
                url: "updateBooking.php",
                type: 'POST',
                dataType: 'json',
                data: {
                    bid: $("input[name='bookID']").val(),
                    type: "pay",
                    paidAmount: $("input[name='payAmount']").val(),
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
        else {
            $(".message").html("Sorry, the amount is not enough. Try again");
            scrollToMessage();
            $("input[name='payAmount']").focus();
            event.preventDefault();
        }
    });

    $("button[name='extend']").click(function(){
        window.location.href = "extend.php";
    });

    $("button[name='delete']").click(function(event){
        $("input[name='status']").val(0);
        var result = window.confirm("Are you sure to cancel plot booking? Paid money is not refundable.");
        if(result){
            // function to update record status in db
            $.ajax({
                url: "updateBooking.php",
                type: 'POST',
                dataType: 'json',
                data: {
                    bid: $("input[name='bookID']").val(),
                    type: "delete",
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

    $("button[name='edit']").click(function(event){
        $("input[name='status']").val(1);
        var result = window.confirm("Are you sure to save changes to the plot booking?");
        if(result){

            $.post(
                "updateBooking.php",
                {
                    type: $(this).attr('name'),
                    bookYear: $("input[name='bookYear']:checked").val(),
                    bid: $("input[name='bookID']").val(),
                },
                function(data, status){
                    alert("Data: " + data + "\nStatus: " + status);
                    window.location.href = "index.php";
                }
            );

        }
        else{
            event.preventDefault();
        }
    });

});