<?php

class DatabaseConnection {
    private $serverName;
    private $username;
    private $password;
    private $dbName;
    private $con;

    public function __construct($serverName, $username, $password, $dbName) {
        $this->serverName = $serverName;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;

        $this->connect();
    }

    private function connect() {
        $this->con = new mysqli($this->serverName, $this->username, $this->password, $this->dbName);

        if ($this->con->connect_error) {
            die("Connection Failed: " . $this->con->connect_error);
        }
    }

    public function getConnection() {
        return $this->con;
    }

    public function closeConnection() {
        if ($this->con) {
            $this->con->close();
        }
    }
}


$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "smart_lamp";

$databaseConnection = new DatabaseConnection($serverName, $username, $password, $dbName);


$con = $databaseConnection->getConnection();


// $databaseConnection->closeConnection();
?>
