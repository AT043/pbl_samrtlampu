<?php  

// Lampirkan dbconfig  
require_once "../dbconfig.php";  

// Cek status login user  
if (!$user->isLoggedIn()) {  
    header("location: ../login.php"); //Redirect ke halaman login  
}  

// Ambil data user saat ini  
$currentUser = $user->getUser();  
?>  

<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Dashboard | SmartLamp</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/styles.css"/>
        <style>

            #datetime {
                color: #ffff;
                background-color: #000d;
            }
      /* @media (min-width: 768px) {
            .slave2-main {
                flex-wrap: wrap;
            }
            .slave2-sub1 {
                margin: 10px;
            }
            .slave2-sub2 {
                margin: 10px;
            }
        }*/
        </style>
    </head>
    <body>
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="navbar">
                <div class="nb-container">
                    <div class="nb-left">
                        <div class="nb-title">SmartLamp</div>
                        <button id="nb-toggle" class="nb-toggle">
                            <div class="nb-i-line"></div>
                            <div class="nb-i-line"></div>
                            <div class="nb-i-line"></div>
                        </button>
                    </div>
                    <div class="nb-right">
                        <p><a href="../about.html">Tentang</a></p>
                        <p><a href="../help.html">Bantuan</a></p>
                    </div>
                </div>
            </nav>
            <div class="container">
                <!-- Sidebar -->
                <div id="sidebar" class="sidebar">
                    <div class="sb-container">
                        <div class="sb-body">
                            <h5 class="sb-title">Menu</h5>
                            <div class="div-line"></div>
                                <a class="sb-item" href="admin.php">
                                    <img src="../assets/icons/remote.svg" alt="home icon" >
                                    Kontrol Lampu
                                </a>
                                <a class="sb-item" href="admin2.php">
                                    <img src="../assets/icons/edit.svg" alt="search icon" />
                                    Data User
                                </a>
                                <a class="sb-item" href="admin3.php">
                                    <img src="../assets/icons/edit.svg" alt="products icon" />
                                    History
                                </a>
                                <!-- <a class="sb-item" href="#">
                                    <img src="../assets/icons/layout.svg" alt="dashboard icon" />
                                    Tentang
                                </a> -->
                        </div>
                        <div class="sb-footer">
                            <img src="../assets/icons/user.svg" alt="user icon" class="user-img" />
                            <h3 class="user-name"><?php echo $currentUser['username'] ?></h3>
                            <a href="#" class="sb-settings-btn">
                                <img src="../assets/icons/settings.svg" alt="settings icon" />
                            </a>
                            <a href="../logout.php" class="sb-logout-btn" >
                                <img src="../assets/icons/log-out.svg" alt="logout icon" />
                            </a>
                        </div>
                    </div>
                </div>
                <!-- CONTENT -->
                <div class="content-i">
                    <div class="content-main">
                        <div class="big-box">
                            <div class="container mt-3">
                                <div class="user-data" id="user-data">
                                    <?php
                                    $auth = new Auth($con);
                                    $data = $auth->getAllUsersAndAdmins();
                                    $users = $data['users'];
                                    ?>

                                    <h3>History Login</h3>
                                    <table id="loginHistory" class="table table-striped table-bordered" style="width:100%">
                                        <!-- Table header -->
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Waktu Login</th>
                                                <!-- Add more columns as needed -->
                                            </tr>
                                        </thead>
                                        <!-- Table body -->
                                        <tbody>
                                            <?php
                                            // Get login history for the current user
                                            $loginHistory = $auth->getLoginHistory($currentUser['id']);

                                            if ($loginHistory) {
                                                foreach ($loginHistory as $log) {
                                                    echo "<tr>";
                                                    echo "<td>{$log['username']}</td>";
                                                    echo "<td>{$log['login_time']}</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='2'>No login history found.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </body>
    <script src="../assets/js/main.js"></script>
    <script type="text/javascript">
        function updateClock() {
            // Get current date and time
            var now = new Date();
            var datetime = now.toLocaleString();

            // Insert date and time into HTML
            document.getElementById("datetime").innerHTML = datetime;
        }

        // Update the clock every second (1000 milliseconds)
        setInterval(updateClock, 1000);
    </script>
</html>
