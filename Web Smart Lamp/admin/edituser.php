<?php 

require_once "../dbconfig.php";

if (isset($_POST['submit'])) {
    // Check if the form is submitted

    // Get the form data
    $password = $_POST["password"];
    $username = $_POST["username"];
    $email = $_POST["email"];

    // Use the insertUser function to add the new user
    $result = $admin->updateUser($username, $password, $email);

    if ($result) {
        echo "<script>alert('Update Data User Berhasil!')</script>";
        header('location: admin2.php');
    } else {
        echo "Error inserting record: " . $admin->getLastError();
        echo "<script>alert('Error Updating Record')</script>";
    }
}

?>