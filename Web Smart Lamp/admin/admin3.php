<?php  

// Lampirkan dbconfig  
require_once "../dbconfig.php";  

// Cek status login user  
if (!$person->isLoggedIn()) {  
    header("location: ../login.php"); //Redirect ke halaman login  
}  

// Ambil data user saat ini  
$currentUser = $admin->getUser();  
?>  

<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Dashboard | SmartLamp</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css"/>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <!-- DataTables JS -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        
        <style>
            .big-box {
                background-color: #fff;
                border: 1px solid #ccc;
                width: 900px;
                height: 600px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }

            .medium-box {
                background-color: #fff;
                border: 1px solid #ccc;
                width: 900px;
                height: 400px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }

            #userdata,
            #admindata {
            width: 100%;
            }

            #userdata th,
            #userdata td,
            #admindata td,
            #admindata th {
                text-align: center;
                height: 10px;
                padding: 5px; /* Adjust the padding as needed */
                font-size: 22px; /* Adjust the font size as needed */
            }

            .content-main {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .btn-edit {
                width: 30px;
                background-color: skyblue;
                color: white;
                padding: 5px;
                margin: 0 10px; 
            }

            .btn-delete {
                width: 30px;
                background-color: red;
                color: white;
                padding: 5px;
                margin: 0 10px;
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
        <div class="wrapper-i">
            <!-- Navbar -->
            <nav class="navbar-i">
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
            <div class="container-i">
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
                                <img src="../assets/icons/layout.svg" alt="search icon" />
                                Data User
                            </a>
                            <a class="sb-item" href="admin3.php">
                                <img src="../assets/icons/edit.svg" alt="search icon" />
                                History
                            </a>
                            <a class="sb-item" href="admin4.php">
                                <img src="../assets/icons/grid.svg" alt="products icon" />
                                Data Sensor
                            </a>
                            <div style="margin-top: 20%; background-color: #000d">
                                <p id="time" style="color: lightgreen; font-family: monospace; font-size: 24px; text-align: center;"></p>
                                <p id="date" style="color: lightgreen; font-family: monospace; font-size: 24px; text-align: center;"></p>
                            </div>
                        </div>
                        <div class="sb-footer">
                            <img src="../assets/icons/user.svg" alt="user icon" class="user-img" />
                            <h3 class="user-name"><?php echo $currentUser['username'] ?></h3>
<!--                             <a href="#" class="sb-settings-btn">
                                <img src="../assets/icons/settings.svg" alt="settings icon" />
                            </a> -->
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
                                <h3>History Login</h3>
                                <table id="loginHistory" class="table table-striped table-bordered" style="width:100%" border="1">
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
                                            $loginHistory = $admin->getLoginHistory();

                                            if ($loginHistory && isset($loginHistory['logs'])) {
                                                foreach ($loginHistory['logs'] as $log) {
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
    </body>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/time.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('#loginHistory').DataTable({
                "lengthMenu": [3, 5, 7], // Set the available choices for the number of rows per page
                "pageLength": 7  // Set the default number of rows per page
            });
        });
    </script>
</html>
