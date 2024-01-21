<?php 
require_once '../dbconfig.php';

// Cek status login user
if ($person->isLoggedIn()) {
    // Check if it's an admin or a regular user
    $userData = $admin->getUser(); // Assuming you have a method to get user data
    if ($userData['permissions'] == 1) {
        // Admin
        header("location: admin.php");
    } else {
        // User
        header("location: ../user/userdashboard.php");
    }
    exit(); // Ensure the script stops here to prevent further execution
}

header("location: ../login.php");

?>