<?php 
    
    session_start();
    
    // Function to insert user data to DB
    function saveUserData($conn){

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $tel = $_POST['tel'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(isset($fname) && isset($lname) && isset($tel) && 
            isset($address) && isset($email) && isset($password)){
            // Auto set to customer
            // As based on the CD, only customer can register them self
            $role = 3;

            if(isset($_POST['role'])){
                $role = $_POST['role'];
            }

            // Password hashing
            $hashPwd = password_hash($password, PASSWORD_BCRYPT);

            $insertUser = "INSERT INTO user (firstName, lastName, email, contactNo, 
                homeAddress, status, password, roleID) VALUES ('" . $fname . 
                "', '" . $lname . "', '" . $email . "', '" . $tel . "', '" . 
                $address . "', '" . 0 . "', '" . $hashPwd . "', '" . $role . "')" or
                die("Error inserting new record");

            if($conn->query($insertUser)){
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $hashPwd;
                echo "<meta http-equiv=\"refresh\" content=\"2;URL=security.php\">";
            }
            else{
                echo "Error: " . $insertUser . "<br>" . $conn->error;
                echo "<meta http-equiv=\"refresh\" content=\"3;URL=register.html\">";
            }
        }
        else{
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=register.html\">";
        }

    }

    // Function to retrieve user data from DB based on email and status
    function getUserByEmail($conn, $email, $status){
        $retrieveUser = "SELECT * FROM user WHERE status = " . $status . " AND email = '" . $email . "'";
        $result = $conn->query($retrieveUser);

        if($result){
            // Fetch data 
            $userData = $result->fetch_assoc();

            return $userData;
        }
        else {
            return false;
        }
    }

    // Function to update user status
    function updateUserStatus($conn, $email, $status){
        $sql = "UPDATE user SET status = '" . $status . "' WHERE email = '" . $email . "'";
        if($conn->query($sql)){
            return true;
        }
        else{
            return false;
        }
    }

    // Function to insert security answer to db
    function saveSecurityAnswer($conn){
        $ques1 = $_POST["ques1"];
        $ques2 = $_POST["ques2"];
        $ans1 = $_POST["ans1"];
        $ans2 = $_POST["ans2"];

        if(isset($ques1) && isset($ques2) && isset($ans1) && isset($ans2)){

            $getUser = getUserByEmail($conn, $_SESSION['email'], 0);

            $getUserID = $getUser["userID"];

            var_dump("This is the user id: " . $getUserID);

            $insertAnswer = "INSERT INTO answer(answerSentence, status, questionID, userID) VALUES
            ($ans1, 1, $ques1, $getUserID), ($ans2, 1, $ques2, $getUserID)";

            $result = $conn->query($insertAnswer);

            if($result){
                $updateResult = updateUserStatus($conn, $_SESSION['email'], 1);

                return $updateResult;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
?>