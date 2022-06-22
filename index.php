<?php 
define("DB_SERVERNAME","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD", "");
define("DB_NAME","university");
define("DB_PORT", 3306);

$connectDB = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

if($connectDB && $connectDB->connect_error) {
    echo "Error in DataBase connection" . $connectDB->connect_error;
    die();
}

$sql = "SELECT * FROM `departments`;";
$result = $connectDB->query($sql);
var_dump($result);
?>
