<?php

include "conn.php";


$id = $_POST["id"];

$sql = "SELECT * from Theory WHERE id like '" . $id. "'";
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