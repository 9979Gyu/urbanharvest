<?php
    function getCurrentDTByTimezone(){
        date_default_timezone_set('Asia/Kuala_Lumpur');

        return date("Y-m-d H:i:s");
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
        AND booking.isExtend = '" . $isExtend . "' 
        ORDER BY booking.bookDateTime DESC 
        LIMIT 1";

        $result = $conn->query($sql);

        if($result->num_rows > 0){
            return $result;
        }
        else{
            return false;
        }
    }

    function getAllBooking($conn){
        $sql = "SELECT * FROM booking 
        JOIN plot ON plot.plotID = booking.plotID
        JOIN garden ON garden.gardenID = plot.gardenID
        WHERE booking.status = 1 
        ORDER BY booking.bookDateTime DESC";

        $result = $conn->query($sql);

        if($result->num_rows > 0){
            return $result;
        }
        else{
            return false;
        }

    }
?>