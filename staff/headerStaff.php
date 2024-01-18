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
                        <li>
                            <a href='#'>Garden</a>
                                <ul class='innerlist'>
                                    <li><a href='../garden/addgarden.php'><i class='fas fa-plus'></i>Add Garden</a></li>
                                    <li><a href='../garden/viewGarden.php'><i class='fas fa-edit'></i>Manage Garden</a></li>
                                    <li><a href='../garden/addplot.html'><i class='fas fa-plus'></i>Add Plot</a></li>
                                    
                                </ul>
                        </li>
                        <li>
                            <a href=''>User</a>
                                <ul class='innerlist'>
                                    <li><a href='staff-add-cust.php'>Customer</a></li>      
                                </ul>
                        </li>";
?>

        <li><a href='#'><?php echo $_SESSION['fname'] ?></a>
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