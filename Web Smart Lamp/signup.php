<?php

require('koneksi.php');

// session_start();
$error = '';
$validate = '';

if (isset($_POST['daftar'])) {

    $username = stripslashes($_POST['newUsername']);
    $username = mysqli_real_escape_string($con, $username);
    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($con, $email);
    $token = stripslashes($_POST['tokenAdmin']);
    $token = mysqli_real_escape_string($con, $token);
    $password = stripslashes($_POST['newPassword']);
    $password = mysqli_real_escape_string($con, $password);
    $repass = stripslashes($_POST['rePassword']);
    $repass = mysqli_real_escape_string($con, $repass);
    // $user_acc = !empty(trim($username)) && !empty(trim($email)) && empty(trim($token)) && !empty(trim($password)) && !empty(trim($repass));
    // $admin_acc = !empty(trim($username)) && !empty(trim($email)) && !empty(trim($token)) && !empty(trim($password)) && !empty(trim($repass)); 
  
    if (!empty(trim($username)) && !empty(trim($email)) && !empty(trim($token)) && !empty(trim($password)) && !empty(trim($repass))) {
        if ($password == $repass) {
            if (cek_uname_admin($username, $con) == 0) {
                if (cek_token($token, $con) == 1) {
                    if (token_avail($token, $con) == 0) {
                        $pass = password_hash($password, PASSWORD_DEFAULT);
                        $query = "INSERT INTO admin_account (username, email, password, token) VALUES ('$username', '$email', '$pass', '$token')";
                        $result = mysqli_query($con, $query);
                    
                        if ($result) {
                            $_SESSION['username'] = $username;
                            header('Location: login.php');
                            exit;
                        } else {
                            $error = 'Register Gagal !!';
                        }
                    } else {
                        $error = 'Token Sudah Terdaftar, silahkan login sebagai user';
                        $pass = password_hash($password, PASSWORD_DEFAULT);
               
                        $query = "INSERT INTO user_account (username, email, password) VALUES ('$username', '$email', '$pass')";
                        $result = mysqli_query($con, $query);
                    
                        if ($result) {
                            $_SESSION['username'] = $username;
                            header('Location: login.php');
                            exit;
                        } else {
                            $error = 'Register User Gagal !!';
                        }
                    }
                } else {
                    $error = 'Token Yang Dimasukkan Salah!';
                        $pass = password_hash($password, PASSWORD_DEFAULT);
               
                        $query = "INSERT INTO user_account (username, email, password) VALUES ('$username', '$email', '$pass')";
                        $result = mysqli_query($con, $query);
                    
                        if ($result) {
                            $_SESSION['username'] = $username;
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
    
    } else {
        $error = 'Data tidak boleh kosong !!';
    } 
}

function cek_uname($username, $con)
{
    $uname = mysqli_real_escape_string($con, $username);
    $query = "SELECT * FROM user_account WHERE username = '$uname'";
    $result = mysqli_query($con, $query);
    if ($result) {
        return mysqli_num_rows($result);
    } 
}

function cek_token($token, $con)
{
    $token = mysqli_real_escape_string($con, $token);
    $query = "SELECT * FROM token_admin WHERE token = '$token'";
    $result = mysqli_query($con, $query);
    if ($result) {
        return mysqli_num_rows($result);
    } 
}

function token_avail($token, $con)
{
    $token = mysqli_real_escape_string($con, $token);
    $query = "SELECT * FROM admin_account WHERE token = '$token'";
    $result = mysqli_query($con, $query);
    if ($result) {
        return mysqli_num_rows($result);
    } 
}

function cek_uname_admin($username, $con)
{
    $username = mysqli_real_escape_string($con, $username);
    $query = "SELECT * FROM admin_account WHERE username = '$username'";
    $result = mysqli_query($con, $query);

    if ($result) {
        return mysqli_num_rows($result);
    } 
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