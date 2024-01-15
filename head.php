<!DOCTYPE html>
<html>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="../analysis/dashboard.php">Home</a></li>
                    <?php 
                        if($_SESSION['role'] == 1) {
                            echo "<li><a href='../user/viewUser.php'>User</a></li>";
                        }
                        else if($_SESSION['role'] == 2){
                            echo "<li>
                                <a href='../garden/viewGarden.php'>Garden</a>
                                </li>
                                <li>
                                    <a href='../booking/process.php'>Booking</a>
                                </li>
                                <li>
                                    <a href='../user/viewUser.php'>User</a>
                                </li>";
                        }
                        else if($_SESSION['role'] == 3){
                            echo "<li>
                                    <a href='#'>Booking</a>
                                    <ul class='innerlist'>
                                        <li><a href='../booking/index.php'><i class='fas fa-seedling'></i> Current</a></li>
                                        <li><a href='../booking/history.html'><i class='fas fa-table'></i> History</a></li>
                                        <li><a href='../booking/viewExtend.php'><i class='fas fa-redo'></i> Extend</a></li>
                                    </ul>
                                </li>";
                        }
                    ?>
                    
                    <li>
                        <a href="#"><?php echo $_SESSION['fname'] ?></a>
                        <ul class="innerlist">
                            <li><a href="../user/viewProfile.php"><i class="fas fa-user"></i> Profile</a></li>
                            <li><a href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            <li></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
    </body>
</html>