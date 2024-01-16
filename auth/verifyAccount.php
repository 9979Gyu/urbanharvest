<?php
session_start();
require("../connect.php");

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Get userID based on email from the session
    $getUserIdQuery = "SELECT userID FROM user WHERE email = '$email'";
    $result = $conn->query($getUserIdQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row['userID'];

        $ans1 = $_POST['ans1'];
        $question1 = $_POST['question1'];

        // Check if the answers match existing records
        $checkAnswersQuery = "SELECT * FROM answer WHERE userID = $userID AND 
                              (answerSentence = '$ans1' AND questionID = (SELECT questionID FROM question WHERE sentence = '$question1'))";

        $checkResult = $conn->query($checkAnswersQuery);

        if ($checkResult->num_rows == 1) {
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=changePass.php\">";

        } else {
            echo "Answers do not match existing records.";
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=security.php\">";
        }

    } else {
        // Handle the case where the user is not found
        echo "User not found.";
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=register.html\">";
    }
} else {
    echo "Error";
    echo "<meta http-equiv=\"refresh\" content=\"3;URL=register.html\">";
}

$conn->close();
?> 
