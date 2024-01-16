<!DOCTYPE html>
<html>
    <?php session_start(); ?>
    <head>
        <title>Urban Harvest-Booking</title>
        <link rel="icon" href="../assets/img/logo.png"/>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="../js/script.js"></script>
        <script src="../js/displayDetailBooking.js"></script>
    </head>
    <body>
        <?php 
            require("../head.php"); 
        ?>

        <section class="wrapper">
            <h1 class="title">Booking Details</h1>
            <article>
                <p class="message"></p>
            </article>
            <article id="mainContent" style="margin-bottom: 50px;">
                <table class="mainTable">
                    <!-- <input type="text" name="bid" value="<?php echo isset($_SESSION["bookingID"]) ? $_SESSION["bookingID"] : ''; ?>" hidden/> -->
                    <tbody>
                        <tr>
                            <th colspan="2">Garden</th>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td>
                                <span id="gardenName"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>Plot No:</th>
                            <td>
                                <span id="plotNo"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td>
                                <span id="gardenAddress"></span>
                            </td>
                        </tr>
                    </tbody>
                    
                    <tbody>
                        <tr>
                            <th colspan="2">Booking</th>
                        </tr>
                        <tr>
                            <th>Approval:</th>
                            <th>
                                <span id="bookApproval">Pending</span>
                            </th>
                        </tr>
                        <tr>
                            <th>Date Time:</th>
                            <td>
                                <span id="bookDT"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>Use Year (Maximum is 2):</th>
                            <td>
                                <span id="bookYear"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>Expired:</th>
                            <td>
                                <span id="bookExpired"></span>
                            </td>
                        </tr>
                    </tbody>

                    <tbody>
                        <tr>
                            <th colspan="2">Payment</th>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <th>
                                <span id="paymentStatus">Pending</span>
                            </th>
                        </tr>
                        <tr>
                            <th>Amount (RM 50/year):</th>
                            <td>
                                <span id="amount"></span>
                            </td>
                        </tr>
                        <tr class="amount">
                            <th>Pay Amount (RM):</th>
                            <td>
                                <span id="payAmount"></span>
                            </td>
                        </tr>
                        <tr class="amount">
                            <th>Balance (RM):</th>
                            <td>
                                <span id="balance"></span>
                            </td>
                        </tr>
                        <tr class="amount">
                            <th>Date Time:</th>
                            <td>
                                <span id="payDT"></span>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <div class="btnGroup">
                                    <button type="submit" class="normal" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </article>

        </section>
        <?php require("../foot.php"); ?>
    </body>
</html>