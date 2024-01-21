<?php

class Person{
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
                if (password_verify($password, $data['password'])) {
                    $this->insertLoginHistory($data['username']);
                    $_SESSION['user_session'] = $data['id'];

                    // Implement brute force protection
                    $this->clearLoginAttempts($username);

				if ($data['permissions'] == 1 || $data['permissions'] == 2) {
				    header("location: admin/admin.php");
				} else {
				    header("location: user/userdashboard.php");
				}

                    return true;
                } else {
                    // $this->error = "Username or Password is incorrect";
                    create_alert('error', 'Username dan Password Salah!', 'login.php');
                    $this->handleFailedLoginAttempt($username);
                    return false;
                }
            } else {
                // $this->error = "Username or Password is incorrect";
                create_alert('error', 'Username dan Password Salah!', 'login.php');
                $this->handleFailedLoginAttempt($username);
                return false;
            }
        } catch (PDOException $e) {
            $this->handleError($e);
            return false;
        }
    }


    // Implementing session_regenerate_id for session security
    private function regenerateSession()
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }
    }

    // Implementing brute force protection
    public function handleFailedLoginAttempt($username)
    {
        $this->regenerateSession();

        if (!isset($_SESSION['login_attempts'][$username])) {
            $_SESSION['login_attempts'][$username] = 1;
        } else {
            $_SESSION['login_attempts'][$username]++;
        }

        if ($_SESSION['login_attempts'][$username] >= 3) {
            // Implement time-based lockout or other appropriate actions

            // Check if enough time has passed since the last failed attempt
            $lastAttemptTime = isset($_SESSION['last_attempt_time']) ? $_SESSION['last_attempt_time'] : 0;
            $currentTime = time();

            $timeDifference = $currentTime - $lastAttemptTime;

            // Set the lockout duration (5 minutes in this example)
            $lockoutDuration = 300; // 5 minutes

            if ($timeDifference < $lockoutDuration) {
                $remainingTime = $lockoutDuration - $timeDifference;
                echo "<script>alert('Too many failed login attempts. Please try again in $remainingTime seconds.'); window.location.href='login.php';</script>";
                exit;
            } else {
                // Reset the failed attempts counter and update the last attempt time
                $_SESSION['login_attempts'][$username] = 1;
                $_SESSION['last_attempt_time'] = $currentTime;
            }
        }
    }



    private function clearLoginAttempts($username)
    {
        if (isset($_SESSION['login_attempts'][$username])) {
            unset($_SESSION['login_attempts'][$username]);
        }
    }

    private function handleError($e)
    {
        if ($e->errorInfo[0] == 23000) {
            $this->error = "Username or email has already been used!";
        } else {
            // Log the error instead of echoing it directly
            error_log($e->getMessage());
            $this->error = "An error occurred. Please try again later.";
        }

        // You can customize this part to handle errors in a way suitable for your application
        echo "<script>alert('" . $this->error . "');</script>";
    }



    /**
     * Insert a record into the login_history table.
     *
     * @param int $userId User ID
     * @param string $username Username
     */
    public function insertLoginHistory($username)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO login_history (username, login_time) VALUES (:username, NOW())");
            $stmt->bindParam(":username", $username);
            $stmt->execute();
        } catch (PDOException $e) {
            // Handle error if needed
            echo $e->getMessage();
        }
    }

    /**
     * @return true|void
     *
     * fungsi cek login user
     */
    public function isLoggedIn()
    {
        // Apakah user_session sudah ada di session

        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }

    public function getOTP($username)
    {
        try {
            $stmt = $this->db->prepare("SELECT otp FROM users WHERE username = :username");
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['otp'];
            } else {
                return false; // Jika tidak ada data atau username tidak ditemukan
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function saveOTP($username, $otp, $otpExpirationTime)
    {
        try {
            $stmt = $this->db->prepare("UPDATE users SET otp = :otp, otp_expiration = :otpExpiration WHERE username = :username");
            $stmt->bindParam(":otp", $otp, PDO::PARAM_STR);
            $stmt->bindParam(":otpExpiration", $otpExpirationTime, PDO::PARAM_INT);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);

            // Tambahkan baris berikut untuk debug
            echo "SQL Statement: " . $stmt->queryString . "<br>";
            echo "Username: $username, OTP: $otp, Expiration: $otpExpirationTime <br>";

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
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

?>