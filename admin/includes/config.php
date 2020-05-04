<?php 
// DB credentials.
define('DB_HOST','mysql.zzz.com.ua');
define('DB_USER','satiAR');
define('DB_PASS','Oralbek_15');
define('DB_NAME','sati');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>
