<?php
include "conn.php";
$levelid= $_POST["levelid"];
$userid = $_POST["userid"];
$theoryid = $_POST["theoryid"]; 
$sql = "SELECT Score from Result WHERE Student_Id = '" . $userid . "' AND Level_Id = '" . $levelid. "' AND Theory_Id = '" . $theoryid. "'";
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