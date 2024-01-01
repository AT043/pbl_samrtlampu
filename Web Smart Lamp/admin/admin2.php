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
        <link rel="stylesheet" href="css/styles.css"/>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <!-- DataTables JS -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

        <style>

            #datetime {
                color: #ffff;
                background-color: #000d;
            }

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
                            <a href="logout.php" class="sb-logout-btn" >
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

                                    <h3>Daftar User</h3>
                                    <table id="userdata" class="table table-striped table-bordered" style="width:100%">
                                        <!-- Table header -->
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Update</th>
                                            </tr>
                                        </thead>
                                        <!-- Table body -->
                                        <tbody>
                                            <?php
                                            foreach ($users as $user) {
                                                echo "<tr><td>{$user['username']}</td><td>{$user['email']}</td></td><td><a class='btn-edit' href='update.php?id={$user['id']}'>Edit</a> <a class='btn-delete' href='admin3.php?delete_id={$user['id']}'>Hapus</a></td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <button onclick="showFunction()">Admin</button>
                                </div>

                                <div class="admin-data" id="admin-data" style="display: none;">
                                    <?php
                                    $admins = $data['admins'];
                                    ?>

                                    <h3>Daftar Admin</h3>
                                    <table id="admindata" class="table table-striped table-bordered" style="width:100%">
                                        <!-- Table header -->
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Update</th>
                                            </tr>
                                        </thead>
                                        <!-- Table body -->
                                        <tbody>
                                            <?php
                                            foreach ($admins as $admin) {
                                                echo "<tr><td>{$admin['username']}</td><td>{$admin['email']}</td><td><a class='btn-edit' href='update.php?id={$admin['id']}'>Edit</a> <a class='btn-delete' href='admin3.php?delete_id={$admin['id']}'>Hapus</a></td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <button onclick="showFunction()">User</button>
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
    <script>
        $(document).ready(function() {
            $('#userdata').DataTable({
                "lengthMenu": [2, 4, 6, 8], // Set the available choices for the number of rows per page
                "pageLength": 8  // Set the default number of rows per page
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#admindata').DataTable({
                "lengthMenu": [3, 5, 7], // Set the available choices for the number of rows per page
                "pageLength": 7  // Set the default number of rows per page
            });
        });
        function show(shown, hidden) {
            document.getElementById(shown).style.display='block';
            document.getElementById(hidden).style.display='none';
            return false;
        }
        function showFunction() {
            var x = document.getElementById("user-data");
            var y = document.getElementById("admin-data");

            if (x.style.display === "none" && y.style.display === "block") {
                x.style.display = "block";
                y.style.display = "none";
            } else {
                x.style.display = "none";
                y.style.display = "block";
            }
        }
    </script>
</html>
