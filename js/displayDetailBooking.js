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
        url: 'getDetailsBooking.php',
        type: 'GET',
        dataType: 'json',
        data: {
            isExtend: 0
        },
        success: handleData,
        error: handleData
    });

    // Function to handle the data and execute additional logic
    function handleData(data) {
        console.log(data);
        if (data !== false) {
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
                // Display the saved data in your HTML elements

                savedBookExpired = getExpiredDate(savedBookDT, true,  savedYear);
                
                console.log(savedBookExpired);
                let balance = savedPaid - (savedYear * 50);

                $("span[id='gardenName']").html(savedName);
                $("span[id='plotNo']").html(savedPlot);
                $("span[id='gardenAddress']").html(savedAddress);

                $("span[id='bookDT']").html(savedBookDT);
                $("span[id='bookYear']").html(savedYear);
                $("span[id='bookExpired']").html(savedBookExpired);

                if(savedBookApproval == 0){
                    $("span[id='bookApproval']").html("Pending");
                }
                else if(savedBookApproval == 1){
                    $("span[id='bookApproval']").html("Approved");
                }
                else{
                    $("span[id='bookApproval']").html("Declined");
                }

                // payment status
                if(savedPayStatus == 0){
                    $("span[id='paymentStatus']").html("Pending");
                }
                else if(savedPayStatus == 1){
                    $("span[id='paymentStatus']").html("Paid");
                    $("span[id='payAmount']").html(savedPaid);
                    $("span[id='balance']").html(balance);
                    $("span[id='payDT']").html(savedPayDT);
                }
                else{
                    $("span[id='paymentStatus']").html("Cancelled");
                }

                $("span[id='amount']").html(parseInt(savedYear) * 50);

            } 
            
        }
    }

});