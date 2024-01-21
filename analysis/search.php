<!DOCTYPE html>
<html lang="en">
    <?php session_start(); ?>
    <head>
        <title>Urban Harvest-Search</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../assets/img/logo.png"/>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        
        <script type="text/javascript" src="../js/searchScript.js"></script>
        <link rel="stylesheet" href="../css/style.css" />
    </head>
    <body>
        <?php require("../head.php"); ?>
        <section class="wrapper">
            <!-- <h1 class="title">Search</h1> -->
            <center>
                <div class="searchArea">
                    <form>
                        <table>
                            <tr>
                                <th>Email:</th>
                                <td><input type="email" name="searchEmail" required></td>
                                <td><button name="search" class="submit" type="submit">Search</button></td>
                            </tr>
                        </table>
                    </form>
                </div>  
                <br>
                <article id="mainContent">
                    <div>
                        <h2>Search Result</h2>
                        <br>
                        <p class="message"></p>
                    </div>
                    <br>
                    <!-- user details -->
                    <table class="mainTable">
                        <tbody>
                            <tr>
                                <th>Name:</th>
                                <td><span id="name"></span></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><span id="email"></span></td>
                            </tr>
                            <tr>
                                <th>Contact:</th>
                                <td><span id="contact"></span></td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td><span id="address"></span></td>
                            </tr>
                            <tr>
                                <th>Role:</th>
                                <td><span id="role"></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <br>

                    <table id="bookingRequest" border="border-collapse">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Garden / Plot No</th>
                                <th>Garden Address</th>
                                <th>Book Date Time</th>
                                <th>Use Year</th>
                                <th>Approval</th>
                                <th>Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </article>
            </center>
            <br>
        </section>
        <?php require("../foot.php"); ?>
    </body>
</html>