<?php

include "conn.php";


$email = $_POST["email"];

$sql = "SELECT Student_Id as id, FirstName, LastName from Student
WHERE email = '" . $email . "' ";
$result = $conn->query($sql);

if ($result->num_rows > 0 ) {
	$rows = array();
	while ($row = $result->fetch_assoc()) {
		$rows[] = $row;
	}
	echo json_encode($rows);
}else {
	echo "0";
}

$conn->close();
?>