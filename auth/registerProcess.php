

<?php
include ('../connect.php');

$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$email=$_POST['email'];
$contactNo=$_POST['contactNo'];
$address=$_POST['homeAddress'];
$status=1;
$password=$_POST['password'];
$roleID=3;


$sql = "INSERT INTO user (firstName, lastName, email, contactNo, homeAddress, status, password, roleID) VALUES 
('$firstName', '$lastName', '$email', '$contactNo', '$address','$status', '$password', $roleID)" or die 
("Error inserting data into table");

if ($conn->query($sql) === TRUE) {
	echo "<script>alert('Register successfully!'); window.location.href='security.php';</script>";
} else {
	echo "Error" . $sql . "<br>" . $conn->error;
}
//Closes specified connection
$conn->close();

?>