<?php

include "conn.php";


$levelid = $_POST["levelid"];
$theoryid =$_POST["theoryid"];

$sql = "SELECT localTestNumber as number,localTestNumber-1 as localTestNumber, Task, Choice1, Choice2, Choice3, Answer from Test 
WHERE Level_Id = '" . $levelid. "' AND Theory_Id = '" . $theoryid . "' ";
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