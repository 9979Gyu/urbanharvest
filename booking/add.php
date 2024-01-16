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
                    error: function(xerror) {
                        console.log('Error fetching garden data:', error);
                    }
                });

                $("#gardenName").change(function() {
                    var selectedValue = $(this).val();
                    $.each($retrievedGarden, function(index, garden) {
                        if (garden.gardenID === selectedValue) {
                            console.log(garden.address);
                            $("textarea[name='gardenAddress']").val(garden.address);
                            
                            // $("input[name='plotNo']").val(garden.plotNo);
                            // $("textarea[name='gardenAddress']").val(garden.address);
                            return false;
                        }
                        else{
                            console.log("hello");
                        }
                    });
                });


                function checkDropDown(selector){
                    var selectedValue = $(selector).val();
                    if (selectedValue) {
                        return selectedValue;
                    } 
                    else {
                        selector.focus();
                        return null;
                    }
                }

                $('#addBtn').click(function(){
                    
                    var bookYear = $("input[name='bookYear']:checked").val();
                    var plot = $("input[name='plotNo']").val();
                    var address = $("textarea[name='gardenAddress']").val();

                    var name = checkDropDown("#gardenName");

                    if(name == "none" || bookYear == undefined){
                        $(".message").html("Please select garden.");
                        $("#gardenName").focus();
                    }
                    else{
                        var bookDT = getDate(false, 0);
                        var bookExpired = getDate(true, bookYear);

                        localStorage.setItem("gardenName", name);
                        localStorage.setItem("plotNo", plot);
                        localStorage.setItem("gardenAddress", address);
                        localStorage.setItem("bookYear", bookYear);
                        localStorage.setItem("bookDT", bookDT);
                        localStorage.setItem("bookExpired", bookExpired);
                        localStorage.setItem("bookApproval", "Pending");
                        localStorage.setItem("paymentStatus", "Pending");
                        window.location.href = "index.html"; 
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
            <h1 class="title">Current Booking Details</h1>
            <article>
                <p class="message"></p>
            </article>
            <article class="mainContent">
                <form id="bookPlot">
                    <table>
                        <tbody>
                            <tr>
                                <th colspan="2">Garden</th>
                            </tr>
                            <tr>
                                <th>Name:</th>
                                <td>
                                    <select id="gardenName">
                                        <option value="none" selected>Please Select Garden Name</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Plot No:</th>
                                <td>
                                    <input type="text" name="plotNo" readonly disabled/>
                                </td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>
                                    <textarea name="gardenAddress" readonly disabled cols="30" rows="5"></textarea>
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
                                    <button type="reset" class="normal"><i class="fas fa-eraser"></i> Clear</button>
                                    <button type="button" class="submit" id="addBtn">+ Add</button>
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