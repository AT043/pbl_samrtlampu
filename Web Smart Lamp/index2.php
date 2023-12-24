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
                            header('Location: index.php');
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
                            header('Location: index.php');
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
                            header('Location: index.php');
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
    <meta charset="utf-8">
    <meta lang="en-us">
    <title>Welcome | SmartLamp</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <style type="text/css">
        html, body {
            padding: 0px;
            margin: 0px;
            font-family: "Tahoma";
            color: black;
            height: 100%;
            font-size: 22px;
            background-color: #f0efed;
        }

        main {
            height: 100%;
        }

            .main-container {
                display: flex;
                height: 100%;
            }

            .left-container {
                flex: 40%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .welcome-text {
                font-size: 48px;
                color: #000;
                font-weight: bold;
                white-space: nowrap;
                overflow: hidden;
                text-align: center; /* Keep the text in the middle */
                animation: typing 4s steps(40, end);
                margin: 0px 0px 0px 200px; /* Adjust the margin as needed */
            }

            @keyframes typing {
                from {
                    width: 0;
                }

                to {
                    width: 100%;
                }
            }


            .right-container {
                flex: 60%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

        @media only screen and (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }

            .left-container, .right-container {
                flex: 100%;
            }

            .welcome-text {
                margin: 0; /* Adjust the margin for smaller screens */
            }

            .container {
                width: 100%;
                margin: 20px auto; /* Adjust the margin for smaller screens */
            }

            .tabs .tab {
                flex: 100%;
            }
        }

        .show-password-label {
            display: flex;
        }
        .show-password-label p{
            margin-top: 15px;
            font-size: 18px;
        }
        /*.show-password-label table {
            padding: 10px;
        }*/
        .show-password-label input[type="checkbox"]{
            height: 20px;
            width: 25px;
        }
        .footer {
          display: flex;
          justify-content: center;
          background-color: skyblue;
          margin-bottom:  10px;
         /* height: 50%;*/
        }
        .footer-content {
            height: 30%;
            width: 80%;
            /*padding: 10px;*/
            text-align: center;
            color: black;
        }

        .outter {
          display: flex;
          justify-content: center;
          align-items: center;
        }
        .inner {
          width: 600px;
          height: 480px;
          border: 1px solid #ccc;
          background-color: #fff;
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
          border-radius: 5px;
        }
        .form {
          margin: 10px 20px;
        }
        /*.inner-form {
          margin: 20px 0;
          display: block;
        }
        .inner-form input {
          width: 50%;
          height: 25px;
        }*/
        .submit-button {
          display: flex;
          justify-content: center;
        }
        .submit-button button {
          background-color: #ccc;
          width: 50%;
          height: 35px;
          margin: 10px auto;
        }
        .submit-button button:hover {
          cursor: pointer;
        }

        table {
          margin: 20px 0;
          padding: 20px 0;
        }

        .form-table {
          display: flex;
          justify-content: center;
        }
        table input {
          width: 90%;
          height: 25px;
          margin: 10px 10px;
        }
        .check1 {
          display: flex;
          justify-content: center;
        }

    </style>
</head>

<body>
    <main>
        <div class="main-container">    
        <div class="left-container">
            <div class="welcome-text">
                <p>Hello Stranger!</p>
            </div>
        </div>
        <div class="right-container">
            <div class="outter">
              <div class="inner">
                <div class="form">
                  <form method="post">
                    <div class="form-table">
                      <table width="500">
                        <tr>
                          <td><div class="title">Username</div></td>
                          <td><div class="title">Email</div></td>
                        </tr>
                        <tr>
                          <td><input type="text" id="newUsername" name="newUsername" required></td>
                          <td><input type="email" id="email" name="email" required></td>
                        </tr>
                        <tr>
                          <td><div class="title">Password</div></td>
                          <td><div class="title">Re-Passowrd</div></td>
                        </tr>
                        <tr>
                          <td> <input type="password" id="newPassword" name="newPassword" required></td>
                          <td><input type="password" id="rePassword" name="rePassword" required></td>
                        </tr>
                        <tr>
                          <td><div class="title">Token Admin (Opsional)</div></td>
                          <td><!-- <div class="title">Email</div> --></td>
                        </tr>
                        <tr>
                          <td> <input type="text" id="tokenAdmin" name="tokenAdmin"></td>
                          <td><!-- <input type="email" id="email" name="email" required> --></td>
                        </tr>
                      </table>
                    </div>
                    <div class="submit-button">
                      <button type="submit" name="daftar">Masuk</button>
                    </div>
                  </form>
                  <div class="check1">
                    <p>Sudah Punya Akun? <a href="index.php">Login</a></p>
                    <!-- <div class="show-password-label">
                      <table>
                        <tr>
                          <td><input type="checkbox" id="showPassword" class="checkbox" onclick="seePass()" ></td>
                          <td><p>Tampilkan Password</p></td>
                        </tr>
                      </table>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
        </div>    
      </div>
     <!--  <div class="footer">
        <div class="footer-content">
          <p>&copy; Tim Smart Lamp</p>
          <small>2023</small>
        </div>
    </div> -->
    </main>
    <script type="text/javascript">

        var signin = document.querySelector("#signin");
        var register = document.querySelector("#register");
        setTimeout(function () {
           register.checked = true;
        }, 1000);
        setTimeout(function () {
           signin.checked = true;
        }, 2000);

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

