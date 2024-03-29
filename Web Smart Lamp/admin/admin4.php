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

            #wntable {
              border-collapse: collapse;
              width: 50%;
            }

            #wntable td, #wntable th {
              border: 1px solid #ddd;
              padding: 8px;
            }

            #wntable tr:nth-child(even){background-color: #f2f2f2;}

            #wntable tr:hover {background-color: #ddd;}

            #wntable th {
              padding-top: 12px;
              padding-bottom: 12px;
              text-align: left;
              background-color: #00A8A9;
              color: white;
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
                                Data Lampu
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
                                <div id="cards" class="cards" align="center">
                                  <h1> Data Sensor</h1>
                                  <table id="wntable">
                                  <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                  </tr>
                                    <?php

                                    // Assuming $pdo is your PDO database connection

                                    $query = "SELECT * FROM wemos_table ORDER BY id DESC";
                                    $stmt = $con->query($query);

                                    if ($stmt->rowCount() == 0) {
                                        echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>';
                                    } else {
                                        $no = 6483;
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo '
                                            <tr>
                                                <td>' . $row['id'] . '</td>
                                                <td>' . $row['date'] . '</td>
                                                <td>' . $row['time'] . '</td>
                                            </tr>
                                            ';
                                            $no++;
                                        }
                                    }
                                    ?>

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
