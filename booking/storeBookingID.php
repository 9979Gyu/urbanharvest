<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Check if bookingID is provided in the POST data
        if (isset($_POST['bookingID'])) {
            // Store the booking ID in a session variable
            $_SESSION['bid'] = $_POST['bookingID'];
            echo json_encode(['success' => true]);
            exit();
        }
    }

    // Handle the case where bookingID is not provided
    echo json_encode(['success' => false]);
?>
