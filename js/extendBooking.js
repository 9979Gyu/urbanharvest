$(document).ready(function () {
    var savedID = "";
    var savedName = "";
    var savedPlot = "";
    var savedAddress = "";
    var savedYear = "";
    var extended = 0;

    
    // Make an AJAX request to retrieve data
    $.ajax({
        url: 'getBooking.php',
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
            $("#gardenName option").remove();
            $.each(data, function (index, booking) {
                if (savedID == "") {
                    $("input[name='bookYear']").prop('disabled', false);
                    $("input[name='bookID']").val(booking.bookingID);
                    savedID = booking.gardenID;
                    savedName = booking.name;
                    savedPlot = booking.plotID;
                    savedAddress = booking.address;
                    savedYear = booking.bookYear;
                }

            });
            
            // Check if there is saved data
            if (savedName && savedPlot && savedAddress && savedYear) {
                // Set value
                var option = $('<option>').val(savedID).text(savedName).prop("selected", true);
                $("#gardenName").append(option).val(savedID);

                $("input[name='plotNo']").val(savedPlot);
                $("textarea[name='gardenAddress']").val(savedAddress);
                $("input[name='bookYear'][value='" + savedYear + "']").prop("checked", true);
            }

        }

    }
});
