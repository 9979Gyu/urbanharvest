<!DOCTYPE html>
<html>
    <head>
        <?php session_start(); ?>
        <title>Urban Harvest-Booking</title>
        <link rel="icon" href="../assets/img/logo.png"/>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/exportScript.js"></script>
        <script type="text/javascript" src="../js/processBookingScript.js"></script>

    </head>
    <body>
        <?php 
            require("../head.php");
        ?>
        <section class="wrapper">
            <h1 class="title">Customer Booking</h1>
            <article class="mainContent">

                <div class="btnGroup">
                    <button id="btnExport" class="normal" type="button">Print PDF</button>
                    <button id="excelBtn" class="submit" type="button">Export Excel</button>
                </div>
                <br>

                <div>
                    <input type="radio" name="selection" value="all" checked/> All
                    <input type="radio" name="selection" value="pending" /> Pending
                    <input type="radio" name="selection" value="approved" /> Approved
                    <input type="radio" name="selection" value="declined" /> Declined
                </div>
                <br/>
                
                <table id="bookingRequest" border="border-collapse">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Garden / Plot No</th>
                            <th>Garden Address</th>
                            <th>User</th>
                            <th>Book Date Time</th>
                            <th>Use Year</th>
                            <th>Approval</th>
                            <th>Payment Status</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                        </tr>
                    </tbody>
                </table>
                
            </article>
        </section>
        <?php 
            require("../foot.php");
        ?>
    </body>
</html>