<!DOCTYPE html>
<?php
    session_start();
?>
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
                
                // Make an AJAX request to retrieve data
                $.ajax({
                    url: 'getBooking.php',
                    type: 'GET',
                    dataType: 'json',
                    success: handleData,
                    error: function (error) {
                        console.log('Error fetching booking data:', error);
                    }
                });

                function handleData(data) {
                    if (data !== false) {
                        $("#gardenName option").remove();
                        $.each(data, function (index, booking) {
                            if (savedID == "") {
                                $("input[name='bookYear']").prop('readonly', false);
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
                            // Display the saved data in your HTML elements
                            var option = $('<option>').val(savedID).text(savedName).prop("selected", true);
                            $("#gardenName").append(option).val(savedID);

                            $("input[name='plotNo']").val(savedPlot);
                            $("textarea[name='gardenAddress']").val(savedAddress);
                            $("input[name='bookYear'][value='" + savedYear + "']").prop("checked", true);
                        } 
                        else {
                            $("article:eq(1)").hide();
                            $(".message").html("No booking record exists. You can book <a href='add.php'>here</a>.").css("color", "Red");
                        }

                        $("button[name='submit']").click(function(){
                            savedYear = $("input[name='bookYear']:checked").val();
                        });
                    }
                }
            });
        </script>

    </head>
    <body>
        <?php
            require("../head.php");
        ?>
        <section class="wrapper">
            <h1 class="title">Extend Booking Details</h1>
            <article>
                <p class="message"></p>
            </article>
            <article class="mainContent">
                <p class="message"></p>
                <form id="bookPlot" method="post" action="addExtendBooking.php">
                    <table>
                        <tr>
                            <th colspan="2">Garden</th>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td>
                                <select id="gardenName" name="gardenName" readonly>
                                    <option value="none" selected>Please Select Garden Name</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Plot No:</th>
                            <td>
                                <input type="text" name="plotNo" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td>
                                <textarea name="gardenAddress" readonly cols="30" rows="5"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Use Year (Maximum is 2):</th>
                            <td>
                                <input type="radio" name="bookYear" value="1" checked/> 1 Year
                                <input type="radio" name="bookYear" value="2"/> 2 Years
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="btnGroup">
                                    <button type="submit" name="submit" class="submit">+ Submit</button>
                                    <button type="submit" class="normal" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form> 
            </article>

        </section>
        <?php
            require("../foot.php");
        ?>
    </body>
</html>