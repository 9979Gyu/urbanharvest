<?php 

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

            $checkEmail = "SELECT * FROM user WHERE email = '" . $email . "'";
			$checkTel = "SELECT * FROM user WHERE contactNo = '" . $tel . "'";

			$result1 = $conn->query($checkEmail);
			$result2 = $conn->query($checkTel);

            if($result1->num_rows == 0 && $result2->num_rows == 0){
					
            // Password hashing
            $hashPwd = password_hash($password, PASSWORD_BCRYPT);

            $insertUser = "INSERT INTO user (firstName, lastName, email, contactNo, 
                homeAddress, status, password, roleID) VALUES ('" . $fname . 
                "', '" . $lname . "', '" . $email . "', '" . $tel . "', '" . 
                $address . "', '" . 0 . "', '" . $hashPwd . "', '" . $role . "')" or
                die("Error inserting new record");

            $result = $conn->query($insertUser);

            if($result){
                return getUserByEmail($conn, $email, 0);
            }
            else{
                return false;
            }
        }
        else{
            if($result1->num_rows > 0){
                echo "<script>alert('User already exist'); window.location.href='register.html';</script>";
            }else if($result2->num_rows > 0){
                echo "<script>alert('Phone number already exist'); window.location.href='register.html';</script>";
            }
        }
    }
    else{
        return false;
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
    function saveSecurityAnswer($conn, $uid){
        $ques1 = $_POST["ques1"];
        $ques2 = $_POST["ques2"];
        $ans1 = $_POST["ans1"];
        $ans2 = $_POST["ans2"];

        if(isset($ques1) && isset($ques2) && isset($ans1) && isset($ans2)){

            $insertAnswer = "INSERT INTO answer(answerSentence, status, questionID, userID) VALUES
            ('" . $ans1 . "', '" . 1 . "', '" . $ques1 . "', '" . $uid . "'), 
            ('" . $ans2 . "', '" . 1 . "', '" . $ques2 . "', '" . $uid . "')";

            $result = $conn->query($insertAnswer);

            return $result;
        }
        else{
            return false;
        }
    }
?>