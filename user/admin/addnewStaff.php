<?php
include ('../../connect.php');

$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$email=$_POST['email'];
$contactNo=$_POST['contactNo'];
$address=$_POST['homeAddress'];
$password=$_POST['password'];
$confirmPassword = $_POST['confirmpassword'];


	if(isset($firstName) && isset($lastName) && isset($contactNo) && 
        isset($address) && isset($email) && isset($password) && isset($confirmPassword)){
			$role=2;

			if ($password === $confirmPassword) {
				$checkEmail = "SELECT * FROM user WHERE email = '" . $email . "'";
				$checkTel = "SELECT * FROM user WHERE contactNo = '" . $contactNo . "'";

    			$result1 = $conn->query($checkEmail);
				$result2 = $conn->query($checkTel);

				if($result1->num_rows == 0 && $result2->num_rows == 0){
				
					// Password hashing
					$hashPwd = password_hash($password, PASSWORD_BCRYPT);
		
					$insertUser = "INSERT INTO user (firstName, lastName, email, contactNo, 
						homeAddress, status, password, roleID) VALUES ('" . $firstName . 
						"', '" . $lastName . "', '" . $email . "', '" . $contactNo . "', '" . 
						$address . "', '" . 1 . "', '" . $hashPwd . "', '" . $role . "')" or
						die("Error inserting new record");
		
					if($conn->query($insertUser) === TRUE){
						echo "<script>alert('New record created successfully!'); window.location.href='admin-add-staff.php';</script>";
					}
					else{
						echo "Failed to add staff" . $sql . "<br>" . $conn->error;
					}
				}
				else{
					if($result1->num_rows > 0){
						echo "<script>alert('User already exist'); window.location.href='admin-add-staff.php';</script>";
					}else if($result2->num_rows > 0){
						echo "<script>alert('Phone number already exist'); window.location.href='admin-add-staff.php';</script>";
					}
				}
			} else {
				echo "Passwords do not match!";
				echo "<meta http-equiv=\"refresh\" content=\"2;URL=admin-add-staff.php\">";
			}
		}
		else{
			echo "Fill all the field. <br>" . $conn->error;
		}

	//Closes specified connection
	$conn->close();

?>