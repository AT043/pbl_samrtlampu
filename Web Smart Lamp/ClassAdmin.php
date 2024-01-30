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
     * Insert a new user into the database.
     *
     * @param string $username
     * @param string $password
     * @param string $email
     * @return bool
     */

    public function updateUser($username, $password, $email)
    {
        try {
            // Enkripsi password dengan password_hash (default)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepare the SQL statement
            $stmt = $this->db->prepare("UPDATE users SET username = :new_username, password = :password, email = :email WHERE email = :old_email OR username = :old_username");

            // Bind parameters
            $stmt->bindParam(':new_username', $username);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':old_email', $email);
            $stmt->bindParam(':old_username', $username);

            // Eksekusi statement
            $stmt->execute();

            return true; // Update berhasil
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            return false; // Update gagal
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

    public function displayConfirmationDialog($usernameToDelete) {
        echo "<script>
            var userConfirmed = confirm('Are you sure you want to delete this user?');
            if (userConfirmed) {
                // Redirect to the delete URL if the user clicks 'OK'
                window.location.href = 'admin/admin2.php?delete_id={$user['username']}';
            } else {
                // Redirect to another page or do nothing if the user clicks 'Cancel'
                window.location.href = 'admin/admin2.php';
            }
        </script>";
    }

    public function deleteUser($usernameToDelete) {
        // Use a prepared statement to avoid SQL injection
        $deleteStatement = $con->prepare("DELETE FROM users WHERE username = :username");
        $deleteStatement->bindParam(":username", $usernameToDelete);

        // Execute the query
        if ($deleteStatement->execute()) {
            echo "<script>alert('User deleted successfully.')</script>";
            echo "<meta http-equiv=Refresh content=0;url=../admin/admin2.php>";
        } else {
            echo "Error deleting user.";
        }
    }

    // Example usage:
    //confirmAndDeleteUser($con); // Assuming $con is your database connection


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