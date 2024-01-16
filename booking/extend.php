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
        <script src="../js/bookingScript.js"></script>
        

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