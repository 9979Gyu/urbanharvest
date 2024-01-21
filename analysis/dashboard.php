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
        <title>Urban Harvest-Home</title>
        <link rel="icon" href="../assets/img/logo.png"/>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <?php
            if(isset($_SESSION['email'])){
                require("../head.php");
            }
        ?>
        <section id="dashboard">
            <article class="dash-title">
                <p>Urban Harvest</p>
            </article>
            <article id="vision">
                <h2>Vision</h2>
                <p>To cultivate vibrant and sustainable urban communities through UrbanHarvest, fostering a shared commitment to green living, community engagement, and the creation of thriving, accessible green spaces for all.</p>
            </article>
            <article id="mission">
                <h2>Mission</h2>
                <p>At UrbanHarvest, our mission is to empower individuals and communities to actively participate in the development of green urban landscapes. We provide a user-friendly, web-based platform that enables residents to effortlessly select, reserve, and contribute to community garden plots. Through seamless online transactions, we aim to enhance accessibility to safe, inclusive green spaces, thereby promoting environmental sustainability, community well-being, and the realization of Sustainable Development Goal 11.</p>
            </article>
            <article>
                <h2>Program</h2>
                <div class="flex-container">
                    <img class="center" src="../assets/img/garden1.jpg" alt="community garden" width="30%">
                    <img class="center" src="../assets/img/garden2.jpg" alt="community garden" width="30%">
                    <img class="center" src="../assets/img/garden3.jpg" alt="community garden" width="30%">
                </div>
            </article>
            <article id="collaboration">
                <h2>Collaboration</h2>
                <div>
                    <img src="../assets/img/utem.png"/>
                </div>
            </article>
            <article id="about1">
                <h2>About Us</h2>
                <div class="flex-container">
                    <img class="round" src="../assets/img/member1.jpg"/>
                    <div class="center">
                        <p>Name: Gui Yu Qin</p>
                        <p>Email: <a href="mailto:B032220008@student.utem.edu.my">B032220008@student.utem.edu.my</a></p>
                        <p>Contact: 0129231224</p>
                    </div>
                </div>
                <div class="flex-container">
                    <img class="round" src="../assets/img/member2.jpg"/>
                    <div class="center">
                        <p>Name: Nazarifah Nazurah Binti Ronzi</p>
                        <p>Email: <a href="mailto:B032120057@student.utem.edu.my">B032120057@student.utem.edu.my</a></p>
                        <p>Contact: 0199014704</p>
                    </div>
                </div>
            </article>
            <article id="about2">
                <div class="flex-container">
                    <img class="round" src="../assets/img/member3.jpg"/>
                    <div class="center">
                        <p>Name: Nur Ain Syafikah binti Noor Rozaiman</p>
                        <p>Email: <a href="mailto:B032120020@student.utem.edu.my">B032120020@student.utem.edu.my</a></p>
                        <p>Contact: 0146135501</p>
                    </div>
                    
                </div>
                <div class="flex-container">
                    <img class="round" src="../assets/img/member4.jpg"/>
                    <div class="center">
                        <p>Name: Nurzulaikha Afza Binti Zolkifly</p>
                        <p>Email: <a href="mailto:B032120032@student.utem.edu.my">B032120032@student.utem.edu.my</a></p>
                        <p>Contact: 01117623248</p>
                    </div>
                </div>
            </article>
        </section>
        
        <?php require("../foot.php"); ?>

    </body>
</html>