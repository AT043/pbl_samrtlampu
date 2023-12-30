<?php

/**
 * Class Auth for general authentication functionality
 */
class Auth{
       /**
     * @var PDO
     * Menyimpan Koneksi database
     */
    protected $db;

    /**
     * @var string
     * Menyimpan Error Message
     */
    protected $error;

    /**
     * @param PDO $db_conn 
     * Contructor untuk class Auth, membutuhkan satu parameter yaitu koneksi ke database
     */
    public function __construct($db_conn)
    {
        $this->db = $db_conn;

        // Check if a session is already active before starting a new one
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

        /**
     * @param $name
     * @param $password
     * @param string $userType
     * @return bool
     *
     * Shared login logic for both ordinary users and administrators
     */
    protected function loginUserOrAdmin($name, $password, $userType = 'ordinary')
    {
        try {
            // Check in the users table
            $stmtUser = $this->db->prepare("SELECT * FROM user_account WHERE username = :name");
            $stmtUser->bindParam(":name", $name);
            $stmtUser->execute();
            $userData = $stmtUser->fetch();

            // Check in the admin table
            $stmtAdmin = $this->db->prepare("SELECT * FROM admin_account WHERE username = :name");
            $stmtAdmin->bindParam(":name", $name);
            $stmtAdmin->execute();
            $adminData = $stmtAdmin->fetch();

            // Check if the username exists in either users or admin table
            if ($stmtUser->rowCount() > 0 || $stmtAdmin->rowCount() > 0) {
                // Determine which table to use based on the result
                $data = $stmtUser->rowCount() > 0 ? $userData : $adminData;
                $existingUserType = $stmtUser->rowCount() > 0 ? 'ordinary' : 'admin';

                // Check if the password is correct
                if ($data && password_verify($password, $data['password'])) {
                    // Check if the existing user type matches the intended user type
                    if ($existingUserType !== $userType) {
                        $this->error = "Username sudah digunakan sebagai " . ucfirst($existingUserType) . " user!";
                        return false;
                    }

                    // Check if the username exists in both tables
                    if ($stmtUser->rowCount() > 0 && $stmtAdmin->rowCount() > 0) {
                        $this->error = "Username sudah digunakan sebagai ordinary dan admin user!";
                        return false;
                    }

                    $_SESSION['user_id'] = $data['id'];
                    $_SESSION['user_type'] = $existingUserType;

                    return true;
                } else {
                    $this->error = "Username atau Password Salah";
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
     * @return false
     *
     * fungsi ambil data user yang sudah login
     */
    public function getUser()
    {
        if (!$this->isLoggedIn()) {
            return false;
        }

        try {
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
     * @return true
     *
     * fungsi Logout user
     */
    public function logout()
    {
        session_destroy();
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

    /**
     * @return bool
     *
     * Check if a user is logged in
     */
    public function isLoggedIn()
    {
        return isset($_SESSION['user_session']);
    }


    /**
     * @param PDOStatement $stmt
     * @return bool
     *
     * Eksekusi proses registrasi
     */
    public function executeRegistration(PDOStatement $stmt)
    {
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            if ($e->errorInfo[0] == 23000) {
                $this->error = "Username sudah digunakan!";
                echo "Ga bisa bang";
            } else {
                echo $e->getMessage();
            }
            return false;
        }
    }

}

/**
 * Class UserAuth for ordinary users
 */
class UserAuth extends Auth
{
    /**
     * @param $name
     * @param $email
     * @param $password
     * @return bool
     *
     * Registrasi User baru
     */
    public function register($name, $email, $password)
    {
        $hashPasswd = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO user_account(username, email, password) VALUES(:name, :email, :pass)");

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":pass", $hashPasswd);

        return $this->executeRegistration($stmt);
    }

    /**
     * @param $name
     * @param $password
     * @return bool
     *
     * Login for ordinary users
     */
    public function login($name, $password, $userType = 'ordinary')
    {
        return $this->loginUserOrAdmin($name, $password, $userType);
    }
}

/**
 * Class AdminAuth for administrators
 */
class AdminAuth extends Auth
{
    /**
     * @param $name
     * @param $email
     * @param $password
     * @param $token
     * @return bool
     *
     * Registrasi Admin baru
     */
    public function register($name, $email, $password, $token)
    {
        $hashPasswd = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO admin_account(username, email, password, token) VALUES(:name, :email, :pass, :token)");

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":pass", $hashPasswd);
        $stmt->bindParam(":token", $token);

        return $this->executeRegistration($stmt);
    }

    /**
     * @param $name
     * @param $password
     * @return bool
     *
     * Login for administrators
     */
    public function login($name, $password, $userType = 'admin')
    {
        return $this->loginUserOrAdmin($name, $password, $userType);
    }
}


?>
