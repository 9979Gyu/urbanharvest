<!DOCTYPE html>
<html>
    <?php
        session_start();
    ?>
    <head>
        <title>Urban Harvest-Booking</title>
        <link rel="icon" href="../assets/img/logo.png"/>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="../js/script.js"></script>

        <script>
            $(document).ready(function(){

                $retrievedGarden = null;
                $retrievedPlot = null;

                // Make an AJAX request to retrieve garden data
                $.ajax({
                    url: '../garden/gardenProcess.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $retrievedGarden = data;
                        // Iterate through the data and display it
                        $.each(data, function(index, garden) {
                            $('#gardenName').append('<option value="' + garden.gardenID + '">' + garden.name + '</option>');
                        });
                    },
                    error: function(error) {
                        console.log('Error fetching garden data:', error);
                    }
                });

                function getPlot(gardenID, callback) {
                    $.ajax({
                        url: '../garden/getPlot.php',
                        type: 'GET',
                        data: { gardenID: gardenID },
                        dataType: 'json',
                        success: function(data) {
                            console.log(data.plotID);
                            $retrievedPlot = data;

                            // Call the callback function with the retrieved data
                            callback(data);
                        },
                        error: function(error) {
                            console.log('Error fetching plot data:', error);
                            callback(false); // Pass false to the callback to indicate an error
                        }
                    });
                }

                $("#gardenName").change(function() {
                    var selectedValue = $(this).val();
                    $.each($retrievedGarden, function(index, garden) {
                        if (garden.gardenID === selectedValue) {
                            $("textarea[name='gardenAddress']").val(garden.address);

                            // Use the callback to get the retrievedPlot data
                            getPlot(garden.gardenID, function(retrievedPlot) {

                                // Now you can use the retrievedPlot data
                                if (retrievedPlot !== false) {
                                    $("input[name='plotNo']").val(retrievedPlot.plotID);
                                }
                                else{
                                    $("input[name='plotNo']").val(null);
                                }
                            });

                            return false;
                        } else {
                            $("textarea[name='gardenAddress']").val(null);
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <?php
            require("../head.php");
        ?>
        <section class="wrapper">
            <h1 class="title">Current Booking Details</h1>
            <article>
                <p class="message"></p>
            </article>
            <article class="mainContent">
                <form id="bookPlot" action="addCurrentBooking.php" method="post">
                    <table>
                        <tbody>
                            <tr>
                                <th colspan="2">Garden</th>
                            </tr>
                            <tr>
                                <th>Name:</th>
                                <td>
                                    <select id="gardenName" name="gardenName">
                                        <option value="none" selected>Please Select Garden Name</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Plot No:</th>
                                <td>
                                    <input type="text" name="plotNo" readonly required/>
                                </td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>
                                    <textarea name="gardenAddress" readonly cols="30" rows="5" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>Use Year (Maximum is 2):</th>
                                <td>
                                    <input type="radio" name="bookYear" value="1" checked/> 1
                                    <input type="radio" name="bookYear" value="2"/> 2
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="btnGroup">
                                        <button type="submit" name="submit" class="submit" id="addBtn">+ Add</button>
                                        <button type="reset" class="normal"><i class="fas fa-eraser"></i> Clear</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form> 
            </article>

        </section>
        <?php require("../foot.php"); ?>
    </body>
</html>