<?php
require('koneksi.php');
session_start();
$error = '';
$validate = '';

// Checking if the session username is available; if yes, redirect to the userdashboard page
if (isset($_SESSION['username'])) {
    header('Location: userdashboard.html');
    exit;
}

// Checking if the form is submitted
if (isset($_POST['submit'])) {
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($con, $password);

    // Checking if the form fields are not empty
    if (!empty(trim($username)) && !empty(trim($password))) {
        // Selecting data based on username from the user_account table
        $query  = "SELECT * FROM user_account WHERE username = '$username'";
        $result = mysqli_query($con, $query);
        $rows   = mysqli_num_rows($result);

        if ($rows != 0) {
            $hash = mysqli_fetch_assoc($result)['password'];
            // Verifying the password for user login
            if (password_verify($password, $hash)) {
                $_SESSION['username'] = $username;
                header('Location: userdashboard.html');
                exit;
            } else {
                $error = 'Login gagal! Silakan cek username dan password Anda.';
            }
        } else {
            // If the user is not found in user_account, check in admin_account
            $query  = "SELECT * FROM admin_account WHERE username = '$username'";
            $result = mysqli_query($con, $query);
            $rows   = mysqli_num_rows($result);

            if ($rows != 0) {
                $hash = mysqli_fetch_assoc($result)['password'];
                // Verifying the password for admin login
                if (password_verify($password, $hash)) {
                    $_SESSION['username'] = $username;
                    header('Location: admin.php');
                    exit;
                } else {
                    $error = 'Login gagal! Silakan cek username dan password Anda.';
                }
            } else {
                $error = 'Login gagal! Silakan cek username dan password Anda.';
            }
        }
    } else {
        $error = 'Data tidak boleh kosong!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta lang="en-us">
    <title>Welcome | SmartLamp</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                text-align: center; /* Keep the text in the middle */
                animation: typing 3.5s steps(40, end);
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
          width: 300px;
          height: 380px;
          border: 1px solid #ccc;
          background-color: #fff;
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
          border-radius: 5px;
          overflow: hidden;
        }
        .form {
          margin: 10px 20px;
        }
        .inner-form {
          margin: 20px 0;
          display: block;
        }
        .inner-form input {
          width: 97%;
          height: 25px;
        }
        .submit-button button {
          background-color: yellowgreen;
          width: 100%;
          height: 35px;
          margin: 10px auto;
        }
        .submit-button button:hover {
          cursor: pointer;
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
                    <div class="inner-form">
                      <div class="title">Username</div>
                      <input type="text" id="username" name="username" required>
                    </div>
                    <div class="inner-form">
                      <div>Password</div>
                      <input type="password" id="password" name="password" required>
                    </div>
                    <div class="submit-button">
                      <button type="submit" name="submit">Masuk</button>
                    </div>
                  </form>
                   <div class="input show-password-label">
                      <table>
                        <tr>
                            <td><input type="checkbox" id="showPassword" class="checkbox" onclick="seePass()" ></td>
                            <td><p>Tampilkan Password</p></td>
                        </tr>
                      </table>
                  </div>
                  <p>belum punya akun? <a href="index2.html">Daftar</a></p>
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

