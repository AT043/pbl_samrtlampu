<?php

require('koneksi.php');

session_start();
$error = '';
$validate = '';

if (isset($_POST['register'])) {
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($con, $email);
    $password = stripslashes($_POST['newPassword']);
    $password = mysqli_real_escape_string($con, $password);
    $repass = stripslashes($_POST['rePassword']);
    $repass = mysqli_real_escape_string($con, $repass);

    // Anda dapat mengizinkan tokenAdmin kosong dengan menghapus atau mengkomentari baris berikut
    // $tokenAdmin = stripslashes($_POST['tokenAdmin']);
    // $tokenAdmin = mysqli_real_escape_string($con, $tokenAdmin);

    if (!empty(trim($username)) && !empty(trim($password)) && !empty(trim($repass))) {
        if ($password == $repass) {
            if (cek_nama($username, $con) == 0) {
                $pass = password_hash($password, PASSWORD_DEFAULT);
                // Token Admin akan disertakan hanya jika tidak kosong
                $tokenAdmin = !empty(trim($_POST['tokenAdmin'])) ? mysqli_real_escape_string($con, $_POST['tokenAdmin']) : NULL;
                $query = "INSERT INTO akun_user (username, email, password, tokenAdmin) VALUES ('$username', '$email', '$pass', '$tokenAdmin')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    $_SESSION['username'] = $username;
                    header('Location: admin.html');
                    exit;
                } else {
                    $error = 'Register User Gagal !!';
                }
            } else {
                $error = 'Username sudah terdaftar !!';
            }
        } else {
            $validate = 'Password tidak sama !!';
        }
    } else {
        // Data kosong akan tetap memungkinkan pendaftaran, tanpa menetapkan pesan error
        // $error = 'Data tidak boleh kosong !!';
    }
}


function cek_nama($username, $con)
{
    $nama = mysqli_real_escape_string($con, $username);
    $query = "SELECT * FROM masuk WHERE username = '$nama'";
    if ($result = mysqli_query($con, $query)) {
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
        <div class="input-box">
            <div class="input-box1">
                <h1>Buat Akun Baru</h1>
                <form>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
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
                    <button type="submit">Daftar</button>
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