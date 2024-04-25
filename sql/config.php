<?php
// Connection for php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "oop_project";

$con = mysqli_connect($serverName, $userName, $password, $dbName);

if(mysqli_connect_errno()){
    echo "failed to connect!";
    exit();
}

?>