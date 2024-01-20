<!DOCTYPE html>
<html>
    <body>
    <header>
            <nav>
                <ul>
                    <li><a href="../analysis/dashboard.php">Home</a></li>
                    <?php 
                        if($_SESSION['role'] == 1) {
                            echo '<li>
                            <a href="../auth/manage-security.php">Security</a></li>
                            <li>
                            <a href="#">User</a>
                            <ul class="innerlist">
                                <li><a href="../user/admin/admin-custList.php">Customer</a></li>
                                <li><a href="../user/admin/admin-add-staff.php">Staff</a></li>
                            </ul>
                            </li>
                            <li>
                                <a href="#"> Report</a>
                                <ul class="innerlist">
                                    <li><a href="../report/user_count.php"><i class="fas fa-user"></i> Total Users</a></li>
                                    <li><a href="../report/paid_amount.php"><i class="fas fa-dollar-sign"></i> Total Sales</a></li>
                                    <li><a href="../report/booking_plot.php"><i class="fas fa-book"></i> Total Plots</a></li>
                                </ul>
                            </li>';
                        }
                        else if($_SESSION['role'] == 2){
                            echo '<li>
                            <a href="#">Garden</a>
                                <ul class="innerlist">
                                    <li><a href="../garden/viewGarden.php"><i class="fas fa-edit"></i> Manage Garden</a></li>
                                    <li><a href="../garden/addallplot.php"><i class="fas fa-plus"></i> Add Plot</a></li>
                                </ul>
                                </li>
                                <li>
                                    <a href="../booking/process.php">Booking</a>
                                </li>
                                <li>
                                    <a href="">User</a>
                                    <ul class="innerlist">
                                    <li><a href="../user/staff/staff-add-cust.php">Customer</a></li>
                                </ul>
                                </li>
                                 <li>
                                <a href="#"> Report</a>
                                <ul class="innerlist">
                                    <li><a href="../report/payment_status.php"><i class="fas fa-dollar-sign"></i> Payment Status</a></li>
                                    <li><a href="../report/approval_status.php"><i class="fas fa-check-circle"></i> Approval Status</a></li>
                                </ul>
                                </li>';
                        }
                        else if($_SESSION['role'] == 3){
                            echo "<li>
                                    <a href='#'>Booking</a>
                                    <ul class='innerlist'>
                                        <li><a href='../booking/index.php'><i class='fas fa-seedling'></i> Current</a></li>
                                        <li><a href='../booking/history.php'><i class='fas fa-table'></i> History</a></li>
                                        <li><a href='../booking/viewExtend.php'><i class='fas fa-redo'></i> Extend</a></li>
                                    </ul>
                                </li>";
                        }
                    ?>
                    
                    <li class="is-right">
                        <a href="#"><?php echo $_SESSION['fname'] ?></a>
                        <ul class="innerlist">
                            <li><a href="../user/viewprofile.php"><i class="fas fa-user"></i> Profile</a></li>
                            <li><a href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
    </body>
</html>
