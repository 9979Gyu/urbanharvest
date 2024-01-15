<?php
    function getCurrentDTByTimezone(){
        date_default_timezone_set('Asia/Kuala_Lumpur');

        return date("Y-m-d H:i:s");
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
?>