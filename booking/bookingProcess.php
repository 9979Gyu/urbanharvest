<?php
    function getCurrentDTByTimezone(){
        date_default_timezone_set('Asia/Kuala_Lumpur');

        return date("Y-m-d H:i:s");
    }

    function updateApproval($conn, $bid, $bookApproval){
        $updateBookDT = getCurrentDTByTimezone();
        $sql = "UPDATE booking SET bookApproval = '" . $bookApproval . "', bookDateTime = '" . $updateBookDT . "' WHERE bookingID = '" . $bid . "'";
        $result = $conn->query($sql);
        return $result;
    }

    function updatePayment($conn, $bid, $paidAmount){
        $payDT = getCurrentDTByTimezone();
        $sql = "UPDATE booking SET paidAmount = '" . $paidAmount . "', paymentDateTime = '" . $payDT . "', paymentStatus = 1 WHERE bookingID = '" . $bid . "'";
        $result = $conn->query($sql);
        return $result;
    }

    function updateBookYear($conn, $bid, $useYear){

        $updateSQL = "UPDATE booking SET bookYear = '" . $useYear . "' WHERE bookingID = '" . $bid . "'";

        $result = $conn->query($updateSQL);

        return $result;

    }

    function updateBooking($conn){
        $bid = $_POST['bookID'];
        $useYear = $_POST['bookYear'];
        $paidAmount = $_POST['payAmount'];
        $status = $_POST['status'];
        $payDT = getCurrentDTByTimezone();

        if(isset($bid) && isset($status)){
            $updateBooking = null;
            if($paidAmount != null && $status == 1){
                $updateBooking = "UPDATE booking
                SET bookYear = '" . $useYear . "', 
                paymentStatus = '" . 1 . "', 
                paymentDateTime = '" . $payDT . "',
                paidAmount = '" . $paidAmount . "',
                status = '" . $status . "'
                WHERE bookingID = '" . $bid . "'";
            }
            else if($status == 0){
                $updateBooking = "UPDATE booking
                SET status = '" . $status . "',
                bookApproval = '" . 3 . "' 
                WHERE bookingID = '" . $bid . "'";
            }
            else if($useYear != null && $status == 1){
                $updateBooking = "UPDATE booking
                SET bookYear = '" . $useYear . "'
                WHERE bookingID = '" . $bid . "'";
            }

            $result = $conn->query($updateBooking);
    
            return $result;
        }
        else{
            // return back
            return false;
        }
    }

    function addBooking($conn, $uid, $isExtend){
        $gardenID = $_POST["gardenName"];
        $plotNo = $_POST["plotNo"];
        $address = $_POST["gardenAddress"];
        $bookYear = $_POST["bookYear"];
        $bookDT = getCurrentDTByTimezone();
        $result = false;
        if(isset($gardenID) && isset($plotNo) && isset($address) && isset($bookYear)){

            // query to insert new record to booking
            $addSQL = "INSERT INTO booking (bookDateTime, paymentStatus, bookYear, bookApproval, status, plotID, userID, isExtend)
            VALUES('" . $bookDT . "', '" . 0 . "', '" . $bookYear . "', '" . 0 . "', '" . 1 . "', '" . $plotNo . "', '" . $uid . "', '" . $isExtend . "')" or
            die("Error inserting new record");

            $addResult = $conn->query($addSQL);

            if($addResult){
                $updateSQL = "UPDATE plot SET availability = 0 WHERE plotID = '" . $plotNo . "'";
                $result = $conn->query($updateSQL);
            }

            return $result;

        }
        else{
            return false;
        }

    }

    function addExtendBooking($conn, $uid, $isExtend){
        $gardenID = $_POST["gardenName"];
        $plotNo = $_POST["plotNo"];
        $address = $_POST["gardenAddress"];
        $bookYear = $_POST["bookYear"];
        $bookDT = getCurrentDTByTimezone();

        if(isset($gardenID) && isset($plotNo) && isset($address) && isset($bookYear)){

            // query to insert new record to booking
            $addSQL = "INSERT INTO booking (bookDateTime, paymentStatus, bookYear, bookApproval, status, plotID, userID, isExtend)
            VALUES('" . $bookDT . "', '" . 0 . "', '" . $bookYear . "', '" . 0 . "', '" . 1 . "', '" . $plotNo . "', '" . $uid . "', '" . $isExtend . "')" or
            die("Error inserting new record");

            $result = $conn->query($addSQL);
            return $result;

        }
        else{
            return false;
        }

    }

    function getBooking($conn, $uid, $isExtend){
        $sql = "SELECT * FROM booking 
        JOIN plot ON plot.plotID = booking.plotID
        JOIN garden ON garden.gardenID = plot.gardenID
        WHERE booking.status = 1 
        AND booking.userID = '" . $uid . "' 
        ORDER BY booking.bookDateTime DESC
        LIMIT 2";

        $result = $conn->query($sql);

        if($result->num_rows > 0){
            return $result;
        }
        else{
            return false;
        }
    }

    function getBookingByUid($conn, $uid){
        $sql = "SELECT * FROM booking 
        JOIN plot ON plot.plotID = booking.plotID
        JOIN garden ON garden.gardenID = plot.gardenID
        WHERE booking.userID = '" . $uid . "'
        AND booking.bookDateTime >= DATE_SUB(NOW(), INTERVAL 3 YEAR) 
        ORDER BY booking.bookDateTime DESC";

        $result = $conn->query($sql);

        if($result->num_rows > 0){
            return $result;
        }
        else{
            return false;
        }
    }

    function getAllBooking($conn){
        $sql = "SELECT booking.bookingID, garden.name, booking.plotID, garden.address, user.email, booking.bookDateTime, booking.bookYear, booking.bookApproval, booking.paymentStatus
        FROM booking 
        JOIN plot ON plot.plotID = booking.plotID
        JOIN garden ON garden.gardenID = plot.gardenID
        JOIN user ON user.userID = booking.userID
        WHERE booking.status = 1 
        AND booking.bookDateTime >= DATE_SUB(NOW(), INTERVAL 3 YEAR)
        ORDER BY booking.bookDateTime DESC";

        $result = $conn->query($sql);

        if($result->num_rows > 0){
            return $result;
        }
        else{
            return false;
        }

    }

    function getBookingById($conn, $bid){
        $sql = "SELECT booking.bookingID, garden.name, booking.plotID, garden.address, user.email, booking.bookDateTime, booking.bookYear, booking.bookApproval, booking.paymentStatus, booking.paidAmount, booking.paymentDateTime 
        FROM booking 
        JOIN plot ON plot.plotID = booking.plotID
        JOIN garden ON garden.gardenID = plot.gardenID
        JOIN user ON user.userID = booking.userID
        WHERE booking.status = 1 
        AND booking.bookingID = '" . $bid . "' 
        ORDER BY booking.bookDateTime DESC";

        $result = $conn->query($sql);

        if($result->num_rows > 0){
            return $result;
        }
        else{
            return false;
        }

    }

    // Cancel booking
    function updateBookingStatus($conn, $bid, $extend){

        $getPlot = "SELECT plotID FROM booking WHERE bookingID = '" . $bid . "'";
        $getPlotID = $conn->query($getPlot);
        $getPlotID = $getPlotID->fetch_assoc();

        $sql = "UPDATE booking SET bookApproval = 3, status = 0 WHERE bookingID = '" . $bid . "'";

        $result = $conn->query($sql);

        if($result){
            if($extend == 0){
                $updatePlot = "UPDATE plot SET availability = 1 WHERE plotID = '" . $getPlotID["plotID"] . "'";

                $result = $conn->query($updatePlot);
            }   
        }

        return $result;

    }

    function updateBookingExtend($conn, $uid){
        $updateStatus = "UPDATE booking 
        SET status = 0
        WHERE status = 1  
        AND userID = '" . $uid . "'
        AND bookDateTime <= DATE_SUB(NOW(), INTERVAL bookYear YEAR)";

        $result = $conn->query($updateStatus);

        $sql = "SELECT *
            FROM booking
            WHERE booking.status = 1 
            AND userID = '" . $uid . "'
            ORDER BY booking.bookDateTime DESC
            LIMIT 2";

        $result = $conn->query($sql);

        if($result->num_rows == 1){
            $row = $result->fetch_assoc();

            if ($row['isExtend'] == 1) {
                // Update the isExtend field to 0
                $updateSql = "UPDATE booking SET isExtend = 0 WHERE bookingID = " . $row['bookingID'];
                $result = $conn->query($updateSql);
            }
        }
        else{
            $result = false;
        }

        return $result;

    }
?>