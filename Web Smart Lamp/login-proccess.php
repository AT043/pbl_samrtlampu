<?php

// Lampirkan dbconfig
require_once "dbconfig.php";

//jika ada data yg dikirim
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Proses login user
    if ($person->login($username, $password)) {
        // header("location: index.php");
      $success = true;
    } else {
        // Jika login gagal, ambil pesan error
        $error = $person->getLastError();
    }
}

?>