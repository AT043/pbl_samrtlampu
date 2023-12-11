<?php

require('koneksi.php');

class LoginManager {
    private $con;

    public function __construct($connection) {
        $this->con = $connection;
        session_start();
    }

    public function checkSession() {
        if (isset($_SESSION['username'])) {
            header('Location: userdashboard.html');
            exit;
        }
    }

    public function loginUser($username, $password) {
        $error = '';

        $username = stripslashes($username);
        $username = mysqli_real_escape_string($this->con, $username);
        $password = stripslashes($password);
        $password = mysqli_real_escape_string($this->con, $password);

        if (!empty(trim($username)) && !empty(trim($password))) {
            $userResult = $this->checkUserAccount($username, $password);

            if ($userResult['success']) {
                header('Location: userdashboard.html');
                exit;
            } else {
                $adminResult = $this->checkAdminAccount($username, $password);

                if ($adminResult['success']) {
                    header('Location: admin.html');
                    exit;
                } else {
                    $error = 'Login gagal! Silakan cek username dan password Anda.';
                }
            }
        } else {
            $error = 'Data tidak boleh kosong!';
        }

        return $error;
    }

    private function checkUserAccount($username, $password) {
        $query  = "SELECT * FROM user_account WHERE username = '$username'";
        $result = mysqli_query($this->con, $query);
        $rows   = mysqli_num_rows($result);

        if ($rows != 0) {
            $hash = mysqli_fetch_assoc($result)['password'];
            if (password_verify($password, $hash)) {
                $_SESSION['username'] = $username;
                return ['success' => true];
            }
        }

        return ['success' => false];
    }

    private function checkAdminAccount($username, $password) {
        $query  = "SELECT * FROM admin_account WHERE username = '$username'";
        $result = mysqli_query($this->con, $query);
        $rows   = mysqli_num_rows($result);

        if ($rows != 0) {
            $hash = mysqli_fetch_assoc($result)['password'];
            if (password_verify($password, $hash)) {
                $_SESSION['username'] = $username;
                return ['success' => true];
            }
        }

        return ['success' => false];
    }
}

// Usage
$loginManager = new LoginManager($con);
$loginManager->checkSession();

if (isset($_POST['submit'])) {
    $error = $loginManager->loginUser($_POST['username'], $_POST['password']);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Masuk | Smart LampU</title>
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
        <!-- <?php 
        if ($error) {
                echo '<script language="javascript">';
                echo 'alert("Password/username salah!")';
                echo '</script>';
            }
        ?> -->
       <div class="input-box">
            <div class="input-box1">        
                <h1>Masuk</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group show-password-label">
                        <label for="showPassword">Tampilkan Password</label>
                        <input type="checkbox" id="showPassword" class="checkbox" onclick="seePass()" >
                    </div>
                    <button type="submit" name="submit">Masuk</button>
                </form>
                <div class="sign-in">Belum punya akun? <a href="signup.php">Daftar</a></div>
                <div class="sign-in">atau perlu <a href="help.html">Bantuan</a></div>
		<form name="update" method="post" >
		    <p>Lupa akun? <button name = "update" type="submit">reset</button></p>

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
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>

<?php
if (isset($_POST['update']))
{
exec("/usr/bin/python /var/www/html/mysql.py $input_val");
}
?>
