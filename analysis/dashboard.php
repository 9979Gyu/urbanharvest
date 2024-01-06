<!DOCTYPE html>
<html>
    <?php
        session_start();
    ?>
    <head>
        <title>Urban Harvest-Home</title>
        <link rel="icon" href="../assets/img/logo.png"/>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script>
            $(document).ready(function () {
                if(sessionStorage.getItem("userType") == "Admin"){
                    newNav = '<li><a href="index.html">Home</a></li>' + 
                    '<li><a href="#">Garden</a></li>' + 
                    '<li><a href="booking/process.html">Booking</a></li>' + 
                    '<li><a href="#">User</a></li>' +
                    '<li><a href="#"><i class="fas fa-user"></i></a></li>';
                }
                else {
                    newNav = '<li><a href="index.html">Home</a></li>' +
                    '<li><a href="#">Booking</a><ul class="innerlist"><li>' + 
                    '<a href="booking/index.html"><i class="fas fa-seedling"></i>' + 
                    'Current Booking</a></li><li><a href="booking/history.html">' + 
                    '<i class="fas fa-table"></i>History Booking</a></li>' + 
                    '<li><a href="booking/viewExtend.html"><i class="fas fa-redo"></i>' +
                    'Extend Booking</a></li><li></li></ul></li><li><a href="#">' +
                    '<i class="fas fa-user"></i></a></li>';
                }

                $('#addhere').append(newNav);
            });
        </script>
    </head>
    <body>
        <?php
            if(isset($_SESSION['email'])){
                if($_SESSION['role'] == 1){
                    require("../head.php");
                }
                else if($_SESSION['role'] == 2){
                    require("../headStaff.php");
                }
                else if($_SESSION['role'] == 3){
                    require("../headUser.php");
                }
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
        
        <footer>
            Copyright &copy; ConnectTheDots | 2023
        </footer>
    </body>
</html>