<?php

try {
    $con = new PDO('mysql:host=localhost;dbname=smart_lamp', 'root', '', array(PDO::ATTR_PERSISTENT => true));
} catch (PDOException $e) {
    echo $e->getMessage();
}

// include 'Auth.php';
// include 'ClassLogin.php';
// include 'ClassRegister.php';
include 'ClassPerson.php';
// include 'User.php';
include 'library.php';

// $user = new Auth($con);
// $login = new Login($con);
// $reg = new Register($con);
$person = new Person($con);
// $user = new User($con);

// $dev = new Dev($con);