<?php

$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "pbl_smartlampu";


$con = mysqli_connect($serverName, $username, $password, $dbName);

if (!$con) {
    die("Connection Failed" . mysqli_connect_error());
}