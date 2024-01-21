<?php
// Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the login page
    header("Location: ../auth/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Urban Harvest-Booking</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="icon" href="../assets/img/logo.png"/>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="../js/script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script src="../js/bookingScript.js"></script>
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
            <article id="mainContent" class="mainContent">
                <form id="bookPlot">
                    <input type="text" name="status" value="1" hidden/>
                    <input type="text" name="isExtend" value="0" hidden/>
                    <input type="text" name="bookID" hidden/>
                    <table class="mainTable">
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
                                    <input type="text" name="plotNo" required/>
                                </td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>
                                    <textarea name="gardenAddress" cols="30" rows="5" required></textarea>
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
                                    <span>Pending</span>
                                </th>
                            </tr>
                            <tr>
                                <th>Date Time:</th>
                                <td>
                                    <input type="text" name="bookDT" required/>
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
                                <th>Expired:</th>
                                <td>
                                    <input type="text" name="bookExpired" required />
                                </td>
                            </tr>
                        </tbody>

                        <tbody>
                            <tr class="paySection">
                                <th colspan="2">Payment</th>
                            </tr>
                            <tr class="paySection">
                                <th>Status:</th>
                                <th>
                                    <span>Pending</span>
                                </th>
                            </tr>
                            <tr class="paySection">
                                <th>Amount (RM 50/year):</th>
                                <td>
                                    <span></span>
                                </td>
                            </tr>
                            <tr class="amount">
                                <th>Pay Amount (RM):</th>
                                <td>
                                    <input type="text" name="payAmount"/>
                                </td>
                            </tr>
                            <tr class="amount">
                                <th>Balance (RM):</th>
                                <td>
                                    <input type="text" name="balance" required/>
                                </td>
                            </tr>
                            <tr class="amount">
                                <th>Date Time:</th>
                                <td>
                                    <input type="text" name="payDT" required/>
                                </td>
                            </tr>
    
                            <tr>
                                <td colspan="2">
                                    <div class="btnGroup">
                                        <!-- show if pending payment -->
                                        <button type="submit" name="pay" class="submit"><i class="fas fa-money-bill-wave"></i> Pay</button>
                                        <!-- show if success payment -->
                                        <button type="button" name="extend" class="submit">+ Extend</button>
                                        <!-- show if pending approval -->
                                        <button type="submit" name="edit" class="submit"><i class="fas fa-pen"></i> Edit</button>
                                        <!-- show if pending approval and pending payment -->
                                        <button type="submit" name="delete" class="delete"><i class="fas fa-trash-alt"></i> Cancel</button>
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