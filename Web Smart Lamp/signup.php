<?php

require('koneksi.php');

class RegistrationManager {
    private $con;

    public function __construct($connection) {
        $this->con = $connection;
    }

    public function registerUser($newUsername, $email, $tokenAdmin, $newPassword, $rePassword) {
        $error = '';
        $validate = '';

        $newUsername = stripslashes($newUsername);
        $newUsername = mysqli_real_escape_string($this->con, $newUsername);
        $email = stripslashes($email);
        $email = mysqli_real_escape_string($this->con, $email);
        $tokenAdmin = stripslashes($tokenAdmin);
        $tokenAdmin = mysqli_real_escape_string($this->con, $tokenAdmin);
        $newPassword = stripslashes($newPassword);
        $newPassword = mysqli_real_escape_string($this->con, $newPassword);
        $rePassword = stripslashes($rePassword);
        $rePassword = mysqli_real_escape_string($this->con, $rePassword);

        if ($newPassword == $rePassword) {
            if (!$this->checkUsernameAdmin($newUsername)) {
                if ($this->checkToken($tokenAdmin)) {
                    if (!$this->tokenAvailable($tokenAdmin)) {
                        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                        $query = "INSERT INTO admin_account (username, email, password, token) VALUES ('$newUsername', '$email', '$hashedPassword', '$tokenAdmin')";
                        $result = mysqli_query($this->con, $query);

                        if ($result) {
                            session_start();
                            $_SESSION['username'] = $newUsername;
                            header('Location: login.php');
                            exit;
                        } else {
                            $error = 'Register Gagal !!';
                        }
                    } else {
                        $error = 'Token Sudah Terdaftar, silahkan login sebagai user';
                        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                        $query = "INSERT INTO user_account (username, email, password) VALUES ('$newUsername', '$email', '$hashedPassword')";
                        $result = mysqli_query($this->con, $query);

                        if ($result) {
                            session_start();
                            $_SESSION['username'] = $newUsername;
                            header('Location: login.php');
                            exit;
                        } else {
                            $error = 'Register User Gagal !!';
                        }
                    }
                } else {
                    $error = 'Token Yang Dimasukkan Salah!';
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    $query = "INSERT INTO user_account (username, email, password) VALUES ('$newUsername', '$email', '$hashedPassword')";
                    $result = mysqli_query($this->con, $query);

                    if ($result) {
                        session_start();
                        $_SESSION['username'] = $newUsername;
                        header('Location: login.php');
                        exit;
                    } else {
                        $error = 'Register User Gagal !!';
                    }
                }
            } else {
                $error = 'Username sudah terdaftar !!';
            }
        } else {
            $validate = 'Password tidak sama !!';
        }

        return [
            'error' => $error,
            'validate' => $validate,
        ];
    }

    private function checkUsername($username) {
        $username = mysqli_real_escape_string($this->con, $username);
        $query = "SELECT * FROM user_account WHERE username = '$username'";
        $result = mysqli_query($this->con, $query);

        if ($result) {
            return mysqli_num_rows($result);
        }

        return 0;
    }

    private function checkToken($token) {
        $token = mysqli_real_escape_string($this->con, $token);
        $query = "SELECT * FROM token_admin WHERE token = '$token'";
        $result = mysqli_query($this->con, $query);

        if ($result) {
            return mysqli_num_rows($result) == 1;
        }

        return false;
    }

    private function tokenAvailable($token) {
        $token = mysqli_real_escape_string($this->con, $token);
        $query = "SELECT * FROM admin_account WHERE token = '$token'";
        $result = mysqli_query($this->con, $query);

        if ($result) {
            return mysqli_num_rows($result) > 0;
        }

        return false;
    }

    private function checkUsernameAdmin($username) {
        $username = mysqli_real_escape_string($this->con, $username);
        $query = "SELECT * FROM admin_account WHERE username = '$username'";
        $result = mysqli_query($this->con, $query);

        if ($result) {
            return mysqli_num_rows($result) > 0;
        }

        return false;
    }
}

// Usage
$registrationManager = new RegistrationManager($con);

if (isset($_POST['daftar'])) {
    $result = $registrationManager->registerUser($_POST['newUsername'], $_POST['email'], $_POST['tokenAdmin'], $_POST['newPassword'], $_POST['rePassword']);
    $error = $result['error'];
    $validate = $result['validate'];
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Smart LampU</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        input:focus {
            background-color: lightblue;
        }
        .sign-in a:hover {
            color: red;
            font-weight: bold;
            text-decoration: none;
        }

        button{
            height: 30px;
            width: 70px;
            border: 1px solid black;
            box-shadow: 3px 3px black;
            font-size: 18px;
            margin-bottom: 15px;
            margin-left: 5px;
        }

        button:hover {
            font-weight: bold;
            box-shadow: 1px 1px black;
            cursor:pointer;
        }

        footer{
            margin-top: 80px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/logo2.png" alt="logo1">
        </div>
    </header>
    <main>
    <?php if (!empty($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
        <div class="input-box">
            <div class="input-box1">
                <h1>Buat Akun Baru</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="newUsername">Username</label>
                        <input type="text" id="newUsername" name="newUsername" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
    
                    <div class="form-group">
                        <label for="tokenAdmin">Token Admin (Optional)</label>
                        <input type="text" id="tokenAdmin" name="tokenAdmin">
                    </div>
        
                    <div class="form-group">
                        <label for="newPassword">Password</label>
                        <input type="password" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="rePassword">Ulangi Password</label>
                        <input type="password" id="rePassword" name="rePassword" required>
                    </div>
        
                    <div class="form-group show-password-label">
                        <label for="showPassword">Tampilkan Password</label>
                        <input type="checkbox" id="showPassword" class="checkbox" onclick="seePass()" >
                    </div>
                    <button type="submit" name="daftar">Daftar</button>
                </form>
                <div class="sign-in">Sudah punya akun? <a href="login.php">Masuk</a></div>
                <div class="sign-in">atau perlu <a href="help.html">Bantuan</a></div>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-box">
            <div class="footer-column">
                <div class="footer-logo-main">
                    <img src="assets/logo2.png" alt="" width="240">
                    <img src="assets/help.png" alt="" width="120">
                </div>
                <!-- <div class="footer-logo-sub">
                    <img src="assets/hmtk.JPG" alt="" width="50">
                    <img src="assets/Tmje.JPG" alt="" width="50">
                    <img src="assets/logopnj.png" alt="" width="50">
                </div> -->
            </div>
            <div class="footer-column footer-center">
                <p>&#169; Smart LampU 2023</p>
                <!-- <p>Site is still under</p>
                <p>construction.</p> -->
            </div>
            <div class="footer-column">
                <div class="footer-contact">
                    <h3>Kontak</h3>
                    <a href="mailto:diegogomez81655@gmail.com"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                    <a href=""><i class="fab fa-instagram" aria-hidden="true"></i></a>
                    <a href=""><i class="fa fa-x" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <script>
        function seePass(){
            var x = document.getElementById("newPassword");
            var y = document.getElementById("rePassword")
            if (x.type === "password" && y.type === "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        }
    </script>
</body>
</html>