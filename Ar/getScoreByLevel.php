<?php

include "conn.php";


$levelid = $_POST["levelid"];
$studentid= $_POST["id"];

$sql = "SELECT sum(Score) score from Result
WHERE Level_Id = '" . $levelid. "' AND Student_Id= '" . $studentid . "' Group By Student_Id ";
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