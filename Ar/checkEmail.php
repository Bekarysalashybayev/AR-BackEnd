<?php

include "conn.php";


$loginUser = $_POST["loginUser"];

$sql = "SELECT Student_Id FROM Student WHERE Email = '".$loginUser."' ";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
    echo "Username exists";
}else{
    echo "UserName does not exists";
}

$conn->close();
?>