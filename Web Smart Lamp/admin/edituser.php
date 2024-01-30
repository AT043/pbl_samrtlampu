<?php

require_once "../dbconfig.php";

if (isset($_POST['submit'])) {
    try {
        // Get the form data
        $password = $_POST["password"];
        $username = $_POST["username"];
        $email = $_POST["email"];

        // Use the updateUser function to update the user
        $result = $admin->updateUser($username, $password, $email);

        if ($result) {
            echo "<script>alert('Update Data User Berhasil!')</script>";
            header('location: admin2.php');
            exit(); // Ensure that the script stops execution after redirect
        } else {
            echo "<script>alert('Error Updating Record')</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "')</script>";
    }
}

?>