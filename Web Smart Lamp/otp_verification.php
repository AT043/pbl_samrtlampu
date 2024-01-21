<?php

// Include necessary files and initialize session
require_once "dbconfig.php";
require_once "vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Check if the form is submitted for OTP verification
if (isset($_POST['verify'])) {
    // Retrieve the entered OTP from the form data
    $userEnteredOTP = isset($_POST['otp']) ? trim($_POST['otp']) : '';

    // Check if the OTP has expired
    if (isset($_SESSION["otp_expiration"]) && time() > $_SESSION["otp_expiration"]) {
        $error = "OTP has expired. Please request a new OTP.";
    } else {
        // Compare the entered OTP with the one stored in the session
        if ($userEnteredOTP == $_SESSION["otp"]) {
            // OTP is valid, proceed with registration
            $username = isset($_SESSION['newUsername']) ? $_SESSION['newUsername'] : '';
            $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
            $password = isset($_SESSION['newPassword']) ? $_SESSION['newPassword'] : '';
            $rePassword = isset($_SESSION['rePassword']) ? $_SESSION['rePassword'] : '';

            // Proceed with your existing registration logic here
            if ($person->register($username, $email, $password, $rePassword, '')) {
                // Registration successful
                $success = true;
                header('location: login.php');
                exit();
            } else {
                // Registration failed, get the last error
                $error = $person->getLastError();
            }
        } else {
            // Invalid OTP, show an error message
            $error = "Invalid OTP. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta lang="en-us">
    <title>OTP Verification | SmartLamp</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        main {
            text-align: center;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        p.error-message {
            color: red;
        }
    </style>
</head>

<body>
    <main>
        <div class="container">
            <h2>OTP Verification</h2>
            <?php if (isset($error)) : ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="post">
                <label for="otp">Enter OTP:</label>
                <input type="text" id="otp" name="otp" required>
                <button type="submit" name="verify">Verify OTP</button>
            </form>
        </div>
    </main>
</body>

</html>
