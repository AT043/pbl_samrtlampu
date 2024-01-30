<?php

try {
    $con = new PDO('mysql:host=localhost;dbname=smart_lamp', 'root', '', array(PDO::ATTR_PERSISTENT => true));
} catch (PDOException $e) {
    echo $e->getMessage();
}


require_once 'ClassPerson.php';
require_once 'ClassUser.php';
require_once 'ClassAdmin.php';
require_once 'ClassLamp.php';
require_once 'library.php';

$person = new Person($con);
$admin = new Admin($con);
$user = new User($con);
$lamp = new Lamp($con);
