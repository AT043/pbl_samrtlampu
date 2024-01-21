<?php

class Register
{
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
     * @param string $username
     * @param string $email
     * @param string $password
     * @param string $rePassword
     * @param string|null $token
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
                    create_alert('error', 'Token telah digunakan atau invalid', 'register.php');
                    return false;
                }
            }

            // Check for duplicate username or email
            $stmtDuplicateCheck = $this->db->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
            $stmtDuplicateCheck->bindParam(":username", $username);
            $stmtDuplicateCheck->bindParam(":email", $email);
            $stmtDuplicateCheck->execute();

            if ($stmtDuplicateCheck->rowCount() > 0) {
                create_alert('error', 'Username atau Email sudah pernah digunakan!', 'register.php');
                return false;
            }

            // Check if passwords match
            if ($password == $rePassword) {
                // Insert new user into the database
                $stmt = $this->db->prepare("INSERT INTO users(username, email, password, permissions) VALUES(:username, :email, :pass, :permissions)");
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":pass", $hashPasswd);
                $stmt->bindParam(":permissions", $permissions);

                $stmt->execute();
            } else {
                create_alert('error', 'Password dan Re-Password tidak sesuai!', 'register.php');
                return false;
            }

            return true;
        } catch (PDOException $e) {
            // Jika terjadi error
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * @return string
     *
     * fungsi ambil error terakhir yg disimpan di variable error
     */
    // public function getLastError()
    // {
    //     return show_alert();
    // }
}
