<?php

// Lampirkan dbconfig
require_once "dbconfig.php";

// Cek status login user
if ($login->isLoggedIn()) {
    // Check if it's an admin or a regular user
    $userData = $login->getUser(); // Assuming you have a method to get user data
    if ($userData['permissions'] == 1) {
        // Admin
        header("location: admin/admin.php");
        $login->insertLoginHistory();
    } else {
        // User
        header("location: user/userdashboard.php");
        $login->insertLoginHistory();
    }
    exit(); // Ensure the script stops here to prevent further execution
}

//jika ada data yg dikirim
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Proses login user
    if ($login->login($username, $password)) {
        // header("location: index.php");
      $success = true;
    } else {
        // Jika login gagal, ambil pesan error
        $error = $login->getLastError();
    }
}

?>