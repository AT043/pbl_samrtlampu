<?php

// Lampirkan dbconfig
require_once "dbconfig.php";

// Cek status login user
if ($person->isLoggedIn()) {
    // Check if it's an admin or a regular user
    $userData = $person->isLoggedIn(); // Assuming you have a method to get user data
    if ($userData['permissions'] == 1) {
        // Admin
        header("location: admin/admin.php");
    } else {
        // User
        header("location: user/userdashboard.php");
    }
    exit(); // Ensure the script stops here to prevent further execution
}

// Cek adanya data yang dikirim
if (isset($_POST['daftar'])) {
    $usernama = $_POST['newUsername'];
    $email = $_POST['email'];
    $password = $_POST['newPassword'];
    $repassword = $_POST['rePassword'];
    $token = $_POST['token'];

     
      {  // Proceed with user registration logic
        if ($password == $repassword) {
            // Generate OTP
            $generatedOTP = (int) rand(100000, 999999);

            // Save the generated OTP to the database
            $person->saveOTP($usernama, $generatedOTP, $otpExpirationTime);

            $to = $email;
            $subject = "Verifikasi OTP";
            $message = "Kode OTP Anda adalah: $generatedOTP";
            $headers = "From: daffa.assyam.thariq.an21@mhsw.pnj.ac.id";

            mail($to, $subject, $message, $headers);

            // Store the generated OTP in the session
            $_SESSION["otp"] = $generatedOTP;

            /// Set expiration time for OTP 
            $otpExpirationTime = time() + (5 * 60);
            $_SESSION["otp_expiration"] = $otpExpirationTime;
            //Set user save OTP
            $person->saveOTP($usernama, $generatedOTP, $otpExpirationTime);

            // Menyimpan informasi user di sesi
            $_SESSION['newUsername'] = $usernama;
            $_SESSION['email'] = $email;
            $_SESSION['newPassword'] = $password;
            $_SESSION['rePassword'] = $repassword;
            $_SESSION["otp_expiration"] = $otpExpirationTime;

            // Redirect ke halaman verifikasi OTP
            header("location: otp_verification.php");
            exit();
        } else {
            create_alert('error', 'Password dan Re-Password tidak sesuai!', 'register.php');
        }
    }
}

?>

<!-- HTML -->

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
                flex: 35%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .welcome-text {
                font-size: 48px;
                color: #000;
                font-weight: bold;
                overflow: hidden;
                white-space: nowrap;
                border-right: .05em solid rgb(34, 33, 33);
                line-height: 1%;
                text-align: center; /* Keep the text in the middle */
                letter-spacing: .1em;
                margin: 0px 0px 0px 120px; /* Adjust the margin as needed */
                animation:
                    typing 4.5s steps(20, end),
                    blink-caret .5s step-end infinite;
            }

            @keyframes typing {
                from {
                    width: 0;
                }
                to {
                    width: 100%;
                }
            }

            @keyframes blink-caret {
                from, to { border-color: transparent }
                50% { border-color: rgb(58, 57, 56) }
            }


            .right-container {
                flex: 65%;
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
          font-size: 20px;
        }
        .check1 {
          display: flex;
          justify-content: center;
        }

    </style>
</head>

<body>
  <?php show_alert();?>
    <main>
        <div class="main-container">    
        <div class="left-container">
            <div class="welcome-text">
                <p>Silahkan Daftar</p>
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
<!--                         <tr>
                          <td><div class="title">Token Admin (Opsional)</div></td>
                          <td><!-- <div class="title">Email</div> </td>-->
                        </tr> 
                        <tr>
                          <td>
                            <div class="show-password-label">
                              <input type="checkbox" id="showPassword" class="checkbox" onclick="seePass()" >
                              <p>Tampilkan Password</p>
                            </div>
                          <td><!-- <input type="email" id="email" name="email" required> --></td>
                        </tr>
                      </table>
                    </div>
                    <div class="submit-button">
                      <button type="submit" name="daftar">Masuk</button>
                    </div>
                  </form>
                  <div class="check1">
                    <p>Sudah Punya Akun? <a href="login.php">Login</a></p>
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

