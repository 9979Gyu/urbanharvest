<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Header</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png"/>
    <link rel="stylesheet" href="../../css/admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<?php
    echo "
    <header>
    <nav>
    <ul>
        <li><a href='../../analysis/dashboard.php'>Home</a></li>
            
                <li><a href='../../auth/manage-security.php'>Security</a></li>
                    <li><a href=''>User</a>
                        <ul class='innerlist'>
                            <li><a href='admin-custList.php'>Customer</a></li>
                            <li><a href='admin-add-staff.php'>Staff</a></li>
                        </ul>
                    </li>
                    <li><a href='#'> Report</a>
                        <ul class='innerlist'>
                            <li><a href='../../report/user_count.php'><i class='fas fa-user'></i> Total Users</a></li>
                            <li><a href='../../report/paid_amount.php'><i class='fas fa-dollar-sign'></i> Total Sales</a></li>
                            <li><a href='../../report/booking_plot.php'><i class='fas fa-book'></i> Total Plots</a></li>
                        </ul>
                    </li>";
?>

        <li class="is-right"><a href='#'><?php echo $_SESSION['fname'] ?></a>
<?php
        echo"
            <ul class='innerlist'>
                <li><a href='../viewprofile.php'><i class='fas fa-user'></i> Profile</a></li>
                <li><a href='../../auth/logout.php'><i class='fas fa-sign-out-alt'></i> Logout</a></li>
                <li></li>
            </ul>
        </li>
    </ul>
    </nav>
    </header>";
?>

</html>