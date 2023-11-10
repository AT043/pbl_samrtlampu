<?php


if (isset($_POST['submit'])) {
    $error = false;
    if ($_POST["username"] == "admine" && $_POST["password"] == "12310") {
        header("Location: admin.html");
        exit;
    } elseif (isset($_POST["submit"])) {
        if ($_POST["username"] == "user" && $_POST["password"] == "user12310") {
            header("Location: userdashboard.html");
            exit;
        }   
    } else {
        $error = true;
    }
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
        <?php 
        if ($error) {
                echo '<script language="javascript">';
                echo 'alert("Password/username salah!")';
                echo '</script>';
            }
        ?>
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
                <div class="sign-in">Belum punya akun? <a href="signup.html">Daftar</a></div>
                <div class="sign-in">atau perlu <a href="help.html">Bantuan</a></div>
            </div>
       </div>
    </main>
    <footer>
        <div class="footer-box">
            <div class="footer-column footer-logo">
                <img src="assets/logo2.png" alt="" width="240">
                <img src="assets/logopnj2.png" alt="" width="120">
            </div>
            <div class="footer-column footer-center">
                <p>&#169; Smart LampU 2023</p>
                <p>Site is still under</p>
                <p>construction.</p>
            </div>
            <div class="footer-column footer-contact">
                <ul>
                    <li>
                       <h3>Contact</h3> 
                    </li>
                    <li>
                        <a href="mailto:diegogomez81655@gmail.com"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href=""><i class="fab fa-instagram" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-x" aria-hidden="true"></i></a>
                    </li>
                </ul>
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