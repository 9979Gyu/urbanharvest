<?php
include ('../../connect.php');

$fname=$_POST['firstName'];
$lname=$_POST['lastName'];
$email=$_POST['email'];
$tel=$_POST['contactNo'];
$address=$_POST['homeAddress'];
$password=$_POST['password'];

if(isset($fname) && isset($lname) && isset($tel) && 
isset($address) && isset($email) && isset($password)){
	// Auto set to staff
	$role = 2;

	if(isset($_POST['role'])){
		$role = $_POST['role'];
	}

	// Password hashing
	$hashPwd = password_hash($password, PASSWORD_BCRYPT);

	$insertUser = "INSERT INTO user (firstName, lastName, email, contactNo, 
		homeAddress, status, password, roleID) VALUES ('" . $fname . 
		"', '" . $lname . "', '" . $email . "', '" . $tel . "', '" . 
		$address . "', '" . 1 . "', '" . $hashPwd . "', '" . $role . "')" or
		die("Error inserting new record");

	$result = $conn->query($insertUser);

	if($result){
		echo "<script>alert('New record created successfully!');window.location.href='admin-add-staff.php';</script>";
	}
	else{
		return false;
	}
}
else{
	return false;
}

//Closes specified connection
$conn->close();

?>


            