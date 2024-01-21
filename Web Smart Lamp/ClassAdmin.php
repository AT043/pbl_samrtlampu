<?php

class Admin{
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


    /**
     * @return array|false
     *
     * Get all user and admin data from the database
     */
    public function getAllUsersAndAdmins()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE permissions=0");
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmtAdmin = $this->db->prepare("SELECT * FROM users WHERE permissions=1 OR permissions=2");
            $stmtAdmin->execute();
            $admins = $stmtAdmin->fetchAll(PDO::FETCH_ASSOC);

            return ['users' => $users, 'admins' => $admins];
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Get login history for a specific user.
     *
     * @param int $userId User ID
     * @return array|false Array of login history records or false on failure
     */
    public function getLoginHistory()
	{
	    try {
	        // Tentukan batas jumlah log yang diizinkan
	        $limit = 10;

	        //Periksa jumlah log saat ini
            $countQuery = $this->db->prepare("SELECT COUNT(*) AS total FROM login_history WHERE username = :username");
            $countQuery->bindParam(":username", $username);
            $countQuery->execute();

            $totalLogs = $countQuery->fetchColumn();

            // Jika jumlah log mencapai batas, hapus log tertua
            if ($totalLogs >= $limit) {
                $deleteQuery = $this->db->prepare("DELETE FROM login_history WHERE username = :username ORDER BY login_time ASC LIMIT 1");
                $deleteQuery->bindParam(":username", $username);
                $deleteQuery->execute();
            }

	        // Ambil data login history
	        $stmt = $this->db->prepare("SELECT * FROM login_history ORDER BY login_time DESC LIMIT :limit");
	        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
	        $stmt->execute();
	        $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        return ['logs' => $logs];
	    } catch (PDOException $e) {
	        // Handle error if needed
	        echo $e->getMessage();
	        return false;
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