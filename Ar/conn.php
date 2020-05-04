<?php
$servername = "mysql.zzz.com.ua";
$username = "satiAR";
$password = "Oralbek_15";
$dbname = "sati";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
