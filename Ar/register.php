<?php

include "conn.php";


$firstname= $_POST["firstname"];
$lastname= $_POST["lastname"];
$email= $_POST["email"];
$password= $_POST["password"];

$sql = "Insert into Student(FirstName, LastName, Email, password)
	Values ('" . $firstname. "','" . $lastname. "', '" . $email. "', '" . $password. "')";
if ($conn->query($sql) == TRUE){
		echo "New record created successfully";
	}else{
		echo "Error:" . $sql . "<br>" . $conn->error;
	}

$conn->close();
?>