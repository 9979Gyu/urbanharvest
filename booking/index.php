<!DOCTYPE html>
<?php
    session_start();
?>
<html>
    <head>
        <title>Urban Harvest-Booking</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="icon" href="../assets/img/logo.png"/>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="../js/script.js"></script>

        <script>
            $(document).ready(function () {
                sessionStorage.setItem("userType", "customer");
                var savedName = localStorage.getItem("gardenName");
                var savedPlot = localStorage.getItem("plotNo");
                var savedAddress = localStorage.getItem("gardenAddress");
                var savedBookDT = localStorage.getItem("bookDT");
                var savedBookExpired = localStorage.getItem("bookExpired");
                var savedYear = localStorage.getItem("bookYear");
                $("input[name='bookYear']").prop('disabled', false);

                // Check if there is saved data
                if (savedName && savedPlot && savedAddress && savedYear && savedBookDT) {
                    // Display the saved data in your HTML elements
                    var option = $('<option>').val(savedName).text(savedName);
                    $("#gardenName").append(option).val(savedName);

                    $("input[name='plotNo']").val(savedPlot);
                    $("textarea[name='gardenAddress']").val(savedAddress);
                    $("input[name='bookDT']").val(savedBookDT);
                    $("input[name='bookYear'][value='" + savedYear + "']").prop("checked", true);
                    $("input[name='bookExpired']").val(savedBookExpired);
                    $("span:eq(0)").html(localStorage.getItem("bookApproval"));
                    $("span:eq(1)").html(localStorage.getItem("paymentStatus"));
                    $("span:eq(2)").html(parseInt(savedYear) * 50);

                    if(localStorage.getItem("balance") && localStorage.getItem("payAmount") && localStorage.getItem("payDT")){
                        $("input[name='balance']").val(localStorage.getItem("balance"));
                        $("input[name='payAmount']").val(localStorage.getItem("payAmount"));
                        $("input[name='payAmount']").prop('disabled', true);
                        $("input[name='payDT']").val(localStorage.getItem("payDT"));
                    }

                    buttonControl();
                } 
                else {
                    $("article:eq(1)").hide();
                    $(".message").html("No booking record exists. You can book <a href='add.php'>here</a>.").css("color", "Red");
                }

                if($("span:eq(0)").html().toUpperCase() === "DECLINED"){
                    $(".paySection").hide();
                }

                $("button[name='pay']").click(function () {
                    var amount = parseFloat($("input[name='payAmount']").val());

                    if (isNaN(amount)) {
                        $(".message").html("Please enter numbers only");
                        scrollToMessage();
                        $("input[name='payAmount']").focus();
                    } 
                    else if (amount >= 50 * savedYear) {
                        var balance = amount - 50 * savedYear;
                        var payDT = getDate(false, 0);
                        alert("Thank you.");
                        $("input[name='balance']").val(balance);
                        $("input[name='payDT']").val(payDT);
                        $("span:eq(1)").html("Paid");
                        $(".message").hide();

                        localStorage.setItem("balance", balance);
                        localStorage.setItem("payDT", payDT);
                        localStorage.setItem("paymentStatus", "Paid");
                        localStorage.setItem("payAmount", amount);

                        buttonControl();
                    } 
                    else {
                        $(".message").html("Sorry, the amount is not enough. Try again");
                        scrollToMessage();
                        $("input[name='payAmount']").focus();
                    }
                });

                function buttonControl(){

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
                    else if($("span:eq(1)").html().toUpperCase() == "PAID"){
                        $("button[name='extend']").show();
                        $(".amount").show();
                        $("input[name='bookYear']").prop('disabled', true);
                    }
                    
                }

                $("button[name='extend']").click(function(){
                    window.location.href = "extend.html";
                });

                $("button[name='delete']").click(function(){
                    var result = window.confirm("Are you sure to cancel plot booking? Paid money is not refundable.");
                    if(result){
                        localStorage.clear();
                        window.location.reload();
                    }
                });

                $("button[name='edit']").click(function(){
                    var result = window.confirm("Are you sure to save changes to the plot booking?");
                    if(result){
                        var newBookYear = $("input[name='bookYear']:checked").val();
                        localStorage.setItem("bookDT", getDate(false, newBookYear));
                        localStorage.setItem("bookExpired", getDate(true, newBookYear));
                        localStorage.setItem("bookYear", newBookYear);
                        $("span:eq(2)").html(parseInt(savedYear) * 50);
                        $("input[name='bookDT']").val(localStorage.getItem("bookDT"));
                        $("input[name='bookExpired']").val(localStorage.getItem("bookExpired"));
                    }
                });

                if(localStorage.getItem("extendYear")){
                    $("button[name='extend']").hide();
                }

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
            <article id="mainContent" class="mainContent">
                <form id="bookPlot">
                    <table class="mainTable">
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
                                    <input type="text" name="bookDT" readonly disabled/>
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
                                    <input type="text" name="bookExpired" readonly disabled />
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
                                    <input type="text" name="balance" readonly disabled/>
                                </td>
                            </tr>
                            <tr class="amount">
                                <th>Date Time:</th>
                                <td>
                                    <input type="text" name="payDT" readonly disabled/>
                                </td>
                            </tr>
    
                            <tr>
                                <td colspan="2">
                                    <!-- <button type="submit" class="pay"><img src="/assets/img/pay.png" class="icon"/> Pay</button>
                                    <button type="submit" class="submit"><img src="/assets/img/delete.png" class="icon"/> Pay</button> -->
                                    <!-- show if pending approval and pending payment -->
                                    <button type="button" name="delete" class="delete"><i class="fas fa-trash-alt"></i> Cancel</button>
                                    <!-- show if pending payment -->
                                    <button type="button" name="pay" class="submit"><i class="fas fa-money-bill-wave"></i> Pay</button>
                                    <!-- show if success payment -->
                                    <button type="button" name="extend" class="submit">+ Extend</button>
                                    <!-- show if pending approval -->
                                    <button type="button" name="edit" class="submit"><i class="fas fa-pen"></i> Edit</button>
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