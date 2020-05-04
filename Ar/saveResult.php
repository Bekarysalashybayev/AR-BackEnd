<?php

include "conn.php";


$studentid =$_POST["id"];
$levelid = $_POST["levelid"];
$theoryid= $_POST["theoryid"];
$score= $_POST["score"];

$sql = "SELECT Result_Id FROM Result WHERE Student_Id = '".$studentid."' AND Level_Id = '".$levelid."' AND  Theory_Id = '".$theoryid."' ";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
  echo "ok";
   $sql = "DELETE FROM Result WHERE Student_Id = '".$studentid."' AND Level_Id = '".$levelid."' AND  Theory_Id = '".$theoryid."'";
   $result = $conn->query($sql);
   if ($result) {
	$sql = "INSERT INTO Result(Score, Student_Id, Level_Id, Theory_Id) VALUES('".$score."','".$studentid."','".$levelid."','".$theoryid."')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
	    echo "ok";
        }else {
	echo "0";
        }
    }
}
else{
   echo "000000000";
   	$sql = "INSERT INTO Result(Score, Student_Id, Level_Id, Theory_Id) VALUES('".$score."','".$studentid."','".$levelid."','".$theoryid."')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
	    echo "ok";
        }else {
	echo "0";
        }
}







$conn->close();
?> 

