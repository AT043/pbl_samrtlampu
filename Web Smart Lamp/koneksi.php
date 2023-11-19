<?php

$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "smart_lamp";


$con = mysqli_connect($serverName, $username, $password, $dbName);

if (!$con) {
    die("Connection Failed" . mysqli_connect_error());
} 