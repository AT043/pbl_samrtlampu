<?php

/**
 * Class Auth untuk melakukan login dan registrasi user baru
 */
class Auth
{
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
     * @param $username
     * @param $email
     * @param $password
     * @param $permissions
     * @return bool
     *
     * Registrasi User baru
     */
    public function register($username, $email, $password, $rePassword, $token = null)
    {
        try {
            // buat hash dari password yang dimasukkan
            $hashPasswd = password_hash($password, PASSWORD_DEFAULT);

            // Set default permissions value
            $permissions = 0;

            // Check if a token is provided and it matches a token in the token_admin table
            if (!empty($token)) {
                // Check if the token has already been used
                $stmtToken = $this->db->prepare("SELECT * FROM token_admin WHERE token = :token AND admin IS NULL");
                $stmtToken->bindParam(":token", $token);
                $stmtToken->execute();

                if ($stmtToken->rowCount() > 0) {
                    // Token found and not used, set permissions to 1 for admin
                    $permissions = 1;

                    // Store the username in the admin column of token_admin table
                    $tokenData = $stmtToken->fetch();
                    $adminUsername = $username; // Change this to the appropriate value based on your data model
                    $stmtUpdateAdmin = $this->db->prepare("UPDATE token_admin SET admin = :admin WHERE token = :token");
                    $stmtUpdateAdmin->bindParam(":admin", $adminUsername);
                    $stmtUpdateAdmin->bindParam(":token", $token);
                    $stmtUpdateAdmin->execute();
                } else {
                    // Token has already been used
                    echo "<script>alert('Token has already been used or is invalid.');</script>";
                    return false;
                }
            }


            var_dump($permissions);

            if ($password == $rePassword) {
                //Masukkan user baru ke database
                $stmt = $this->db->prepare("INSERT INTO users(username, email, password, permissions) VALUES(:username, :email, :pass, :permissions)");
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":pass", $hashPasswd);
                $stmt->bindParam(":permissions", $permissions);

                $stmt->execute();

                
            } else {
                echo "<script>alert('Password dan rePassword tida sesuai');</script>";
            }

            return true;
        } catch (PDOException $e) {
            // Jika terjadi error

            if ($e->errorInfo[0] == 23000) {
                //errorInfor[0] berisi informasi error tentang query sql yg baru dijalankan
                //23000 adalah kode error ketika ada data yg sama pada kolom yg di set unique
                $this->error = "Username atau email sudah pernah digunakan!";
                echo "<script>alert('Username, token, atau email sudah pernah digunakan!');</script>";

                return false;
            } else {
                echo $e->getMessage();

                return false;
            }
        }
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     *
     * Function to log in the user
     */
    public function login($username, $password)
    {
        try {
            // Ambil data dari database
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $data = $stmt->fetch();

            // Jika jumlah baris > 0
            if ($stmt->rowCount() > 0) {
                // jika password yang dimasukkan sesuai dengan yg ada di database
                if (password_verify($password, $data['password'])) {
                    // Insert login history record
                    $this->insertLoginHistory($data['id'], $data['username']);

                    $_SESSION['user_session'] = $data['id'];

                    // Check permissions and redirect accordingly
                    if ($data['permissions'] == 1) {
                        // Admin
                        header("location: admin/admin.php");
                    } else {
                        // User
                        header("location: user/userdashboard.php");
                    }

                    return true;
                } else {
                    $this->error = "Username atau Password Salah";
                    echo "<script>alert('Username atau Password Salah');</script>";
                    return false;
                }
            } else {
                $this->error = "Username atau Password Salah";

                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    /**
     * Insert a record into the login_history table.
     *
     * @param int $userId User ID
     * @param string $username Username
     */
    private function insertLoginHistory($username)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO login_history (username, timestamp) VALUES (:username, NOW())");
            $stmt->bindParam(":username", $username);
            $stmt->execute();
        } catch (PDOException $e) {
            // Handle error if needed
            echo $e->getMessage();
        }
    }

    /**
     * @return bool
     * Check if the user is logged in and if the session has not expired.
     */
    public function isLoggedIn()
    {
        // Apakah user_session sudah ada di session
        if (isset($_SESSION['user_session'])) {
            // Check if the session timeout has not been reached
            $lastActivity = isset($_SESSION['last_activity']) ? $_SESSION['last_activity'] : 0;
            $timeoutSeconds = 7200; // 2 hours

            if (time() - $lastActivity < $timeoutSeconds) {
                // Update the last activity timestamp to the current time
                $_SESSION['last_activity'] = time();
                return true;
            } else {
                // Session has expired, log the user out
                $this->logout();
                return false;
            }
        }

        return false;
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

    /**
     * Get login history for a specific user.
     *
     * @param int $userId User ID
     * @return array|false Array of login history records or false on failure
     */
    public function getLoginHistory($userId)
    {
        try {
            // Tentukan batas jumlah log yang diizinkan
            $limit = 50;

            // Periksa jumlah log saat ini
            $countQuery = $this->db->prepare("SELECT COUNT(*) AS total FROM login_history WHERE id = :id");
            $countQuery->bindParam(":id", $userId);
            $countQuery->execute();

            $totalLogs = $countQuery->fetchColumn();

            // Jika jumlah log mencapai batas, hapus log tertua
            if ($totalLogs >= $limit) {
                $deleteQuery = $this->db->prepare("DELETE FROM login_history WHERE user_id = :user_id ORDER BY timestamp ASC LIMIT 1");
                $deleteQuery->bindParam(":user_id", $userId);
                $deleteQuery->execute();
            }

            // Ambil data login history
            $stmt = $this->db->prepare("SELECT * FROM login_history WHERE id = :id ORDER BY timestamp DESC");
            $stmt->bindParam(":id", $userId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle error if needed
            echo $e->getMessage();
            return false;
        }
    }


    /**
     * @return true
     *
     * fungsi Logout user
     */
    public function logout()
    {
        // Hapus session
        session_destroy();
        // Hapus user_session
        unset($_SESSION['user_session']);

        return true;
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