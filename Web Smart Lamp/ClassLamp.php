<?php

class Lamp{
	/**
     * @var
     * Menyimpan Koneksi database
     */
    private $db;

    /**
     * @var
     * Menyimpan Error Message
     */
    private $error;

    /**
     * @param $db_conn
     * Contructor untuk class Auth, membutuhkan satu parameter yaitu koneksi ke database
     */
    public function __construct($db_conn)
    {
        $this->db = $db_conn;

        // Cek sesi
        if (session_status() == PHP_SESSION_NONE) {
        // Mulai sesi baru
        session_start();
        }
    }

    function retrieveLampStatuses()
    {
        global $con; // Assuming $con is your database connection object

        try {
            $lampStatuses = [];

            // Fetch lamp statuses from the database
            $query = "SELECT no_lampu, status FROM manual_lamp";
            $stmt = $con->prepare($query);
            $stmt->execute();

            // Fetch all rows as an associative array
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Populate the $lampStatuses array
            foreach ($result as $row) {
                $lampStatuses[$row['no_lampu']] = ($row['status'] == 1) ? 'On' : 'Off';
            }

            return $lampStatuses;
        } catch (PDOException $e) {
            // Handle any database connection errors
            echo "Error: " . $e->getMessage() . "<br>";
            return [];
        }
    }

    public function getLampStatusFromStorage($lampNumber)
    {
        global $con; // Assuming $con is your database connection object

        try {
            // Fetch the status of the specified lamp from the database
            $query = "SELECT status FROM manual_lamp WHERE no_lampu = :lampNumber";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':lampNumber', $lampNumber, PDO::PARAM_INT);
            $stmt->execute();

            // Fetch the status as an associative array
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if the result is not empty
            if ($result) {
                // Return the status ('On' if status is 1, 'Off' otherwise)
                return ($result['status'] == 1) ? 'On' : 'Off';
            } else {
                // If the lamp number is not found, return a default status or handle it accordingly
                return 'Unknown';
            }
        } catch (PDOException $e) {
            // Handle any database connection errors
            echo "Error: " . $e->getMessage() . "<br>";
            return 'Error';
        }
    } 

    public function getScheduleData() {
        global $con, $currentUser;

        try {
            $query = "SELECT mulai, selesai, tanggal, status FROM scheduling WHERE id = 1 AND username = :username";
            $stmt = $con->prepare($query);

            // Bind parameters
            $stmt->bindParam(':username', $currentUser['username']);

            // Execute the statement
            if ($stmt->execute()) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                echo json_encode(["error" => "Error: " . $stmt->errorInfo()[2]]);
            }
        } catch (PDOException $e) {
            echo json_encode(["error" => "Error: " . $e->getMessage()]);
        }
    }

    /**
     * @return mixed
     *
     * fungsi ambil error terakhir yg disimpan di variable error
     */
    public function getLastError()
    {
        return $this->error;
    }

}

?>