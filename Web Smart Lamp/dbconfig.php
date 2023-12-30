<?php

try {
    $db_conn = new PDO('mysql:host=localhost;dbname=smart_lamp', 'root', '', array(PDO::ATTR_PERSISTENT => true));
    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Return the database connection
return $db_conn;

?>
