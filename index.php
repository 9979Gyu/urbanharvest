<?php 
    session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Urban Harvest-Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="icon" href="assets/img/logo.png"/>
        <link rel="stylesheet" href="css/authStyle.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        
    </head>

    <body></body>
    <?php
            require("auth/login.html");
    ?>
</html>