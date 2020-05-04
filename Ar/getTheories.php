<?php

include "conn.php";

$sql = "SELECT id, name from Theory";
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