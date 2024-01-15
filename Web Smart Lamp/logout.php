<?php  

// Lampirkan dbconfig  
require_once "dbconfig.php";  

// Logout! hapus session user  
$login->logout();  

// Redirect ke login  
$login->logout();
create_alert("Success","Anda sudah logout dari sistem","login.php");
show_alert();
//header('location: login.php');

?>