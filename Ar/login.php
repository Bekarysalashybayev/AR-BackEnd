<?php

include "conn.php";


$loginUser = $_POST["loginUser"];
$loginPass = $_POST["loginPass"];

$sql = "SELECT Password FROM Student WHERE Email = '".$loginUser."' ";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        if($row[Password] == $loginPass){
            echo "login success";
        }
        else{
            echo "Password incorrect";
        }
    }
}else{
    echo "UserName does not exists";
}

$conn->close();
?>