<?php

include "conn.php";


$theoryid = "1";//$_POST["theoryid"];

$sql = "SELECT Task_Number,Task, Solution, Picture, Answer from Task
WHERE  Theory_Id = '" . $theoryid . "' ";
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