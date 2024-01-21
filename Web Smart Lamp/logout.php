<?php  

// Lampirkan dbconfig  
require_once "dbconfig.php";  

// Logout! hapus session user  
$person->logout();  

// Redirect ke login  
$person->logout();
create_alert("Success","Anda sudah logout dari sistem","login.php");
show_alert();
//header('location: login.php');

?>