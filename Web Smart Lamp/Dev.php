<?php 

// Include your dbconfig.php file and any other necessary libraries

class Dev{

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


    private $espAddress = "http://your-esp-address"; // Replace with your ESP8266 IP or hostname
    private $espPort = 80; // Adjust the port if needed

    public function sendCommand($lampNumber, $status) {
        $url = "{$this->espAddress}:{$this->espPort}/control-endpoint";
        $data = array('lampNumber' => $lampNumber, 'status' => $status);

        // Use cURL or another HTTP library to send the request
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}

?>