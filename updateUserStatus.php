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

        // Update user status to 1
        $updateUserStatus = "UPDATE user SET status = 1 WHERE userID = $userID";

        if ($conn->query($updateUserStatus) === TRUE) {
            // Insert answers into the answer table
            $ans1 = $_POST['ans1'];
            $ans2 = $_POST['ans2'];
            $question1 = $_POST['question1'];
            $question2 = $_POST['question2'];

            $insertAnswer1 = "INSERT INTO answer (answerSentence, status, questionID, userID) 
                              VALUES ('$ans1', 1, (SELECT questionID FROM question WHERE sentence = '$question1'), $userID)";
            $insertAnswer2 = "INSERT INTO answer (answerSentence, status, questionID, userID) 
                              VALUES ('$ans2', 1, (SELECT questionID FROM question WHERE sentence = '$question2'), $userID)";

            if ($conn->query($insertAnswer1) === TRUE && $conn->query($insertAnswer2) === TRUE) {
                echo "<meta http-equiv=\"refresh\" content=\"1;URL=verify.php?email=$email\">";

            } else {
                echo "Failed to access" . $conn->error;
                echo "<meta http-equiv=\"refresh\" content=\"3;URL=security.php\">";
            }
        } else {
            echo "Error updating user status: " . $conn->error;
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
