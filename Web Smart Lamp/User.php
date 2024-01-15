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
        // Cek apakah sudah login
        if (!$this->isLoggedIn()) {
            return false;
        }

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

    /**
     * @return array|false
     *
     * Get all user and admin data from the database
     */
    public function getAllUsersAndAdmins()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE permissions='0'");
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmtAdmin = $this->db->prepare("SELECT * FROM users WHERE permissions='1'");
            $stmtAdmin->execute();
            $admins = $stmtAdmin->fetchAll(PDO::FETCH_ASSOC);

            return ['users' => $users, 'admins' => $admins];
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

}

?>