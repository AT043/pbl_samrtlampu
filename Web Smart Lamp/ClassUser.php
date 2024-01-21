<?php 

class User{
    /**
     * @var PDO
     * Menyimpan Koneksi database
     */
    private $db;

    /**
     * @var string
     * Menyimpan Error Message
     */
    private $error;

    /**
     * @param PDO $db_conn
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

    /**
     * @return false
     *
     * fungsi ambil data user yang sudah login
     */
    public function getUser()
    {
        try {
            // Ambil data user dari database
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(":id", $_SESSION['user_session']);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }


}

?>