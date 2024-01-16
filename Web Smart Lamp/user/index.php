<?php 
require_once '../dbconfig.php';

// Cek status login user
if ($login->isLoggedIn()) {
    // Check if it's an admin or a regular user
    $userData = $login->getUser(); // Assuming you have a method to get user data
    if ($userData['permissions'] == 1) {
        // Admin
        header("location: ../admin/admin.php");
        $login->insertLoginHistory();
    } else {
        // User
        header("location: /userdashboard.php");
        $login->insertLoginHistory();
    }
    exit(); // Ensure the script stops here to prevent further execution
}

header("location: ../login.php");

?>