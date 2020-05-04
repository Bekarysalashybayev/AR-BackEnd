<?php

include "conn.php";


$levelid = $_POST["levelid"];
$studentid= $_POST["id"];

$sql = "Select t.id id, r.score, t.name from Result r join Theory t on r.Theory_Id = t.id where r.Level_Id = '" . $levelid . "' AND r.Student_Id = '" . $studentid . "'";
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