<?php  

// Lampirkan dbconfig  
require_once "dbconfig.php";  
include_once "Auth.php";

$UserAuth = new UserAuth($db_conn);
$AdminAuth = new AdminAuth($db_conn);

// Logout! hapus session user  
$UserAuth->logout(); 
$AdminAuth->logout(); 

// Redirect ke login  
header('location: login.php');