<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Smart LampU</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="assets/style.css">

    <style>
        .master {
            display: flex;
            height: 100%;
            margin: 0;
        }
        .slave1 {
            flex: 20%;
            border-right: 1px solid #ccc;
            background-color: #fff;
        }
        .slave2 {
            flex: 80%;
        }

        .slave2-sub {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px;
        }

        /*Navbar*/
        .nav-bar {
            border-bottom: 1px solid #ccc;
            background-color: white;
            padding: 8px;
            position: sticky;
            z-index: 999;
            top: 0;
        }

        .nav-bar ul{
            display: flex;
            align-items: center;
            justify-content: right;
        }
        .nav-bar li, .nav-bar p {
            display: inline;
            list-style-type: none;
            margin: 8px 30px;
        }
        .nav-bar a {
            z-index: 1;
            text-decoration: none;
            color: black;
        }

        .nav-bar a:hover{
            font-weight: bold;
            font-size: 26px;
            background-color: black;
            color: white;
        }

        .logos {
            display: flex;
            align-items: center;
            justify-content: center;
            /* border-bottom: 1px solid black; */
            padding: 30px;
        }
        .inner-nav {
            display: flex;
        }
        .inner-nav p {
            margin-right: auto;
            margin-left: 60px;
            font-size: 24px;
            font-weight: bold;
        }

    /*=================================================*/


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

    </style>
</head>
<body>
    <header>
        <div class="nav-bar">
            <div class="inner-nav">
                <p>SmartLamp</p>
                <ul>
                    <li><a href="index.html">Logout</a></li>
                    <li><a href="about.html">Tentang</a></li>
                    <li><a href="help.html">Bantuan</a></li>
                </ul>
            </div>
        </div>
        <!-- <div class="admin-drp">
            <button onclick="dropdownFunction()" class="drop-btn">Admin</button>
            <div id="admin-menu" class="drp-content">
                <a href="">List User</a>
                <a href="">Tambah User</a>
                <a href="">Token Admin</a>
            </div>
        </div> -->
    </header>
    <main>
        <div class="master">
            <div class="slave1">
                <div class="sidebar">
                    <div class="sidebar-menu">
                        <ul>
                            <a href="admin.html"><div class="menu-card"><li>Kontrol Lampu</li></div></a>
                            <a href="admin2.html"><div class="menu-card"><li>Status Lampu</li></div></a>
                            <a href="admin2.html"><div class="menu-card"><li>Data Sensor</li></div></a>
                            <a href="admin3.php"><div class="menu-card" id="active-menu-card"><li>Data Pengguna</li></div></a>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="slave2">
                <div class="slave2-sub">
                    <div class="big-box">
                        <div class="container mt-3">
                            <div class="user-data" id="user-data">
                                <?php
                                require('koneksi.php');
                                $result = mysqli_query($con, "SELECT * FROM user_account");
                                $jumlah_record = mysqli_num_rows($result);
                                ?>

                                <h3>Daftar User</h3>
                                <table id="userdata" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_row($result)) {
                                            echo "<tr><td>$row[1]</td><td>$row[2]</td><td><a href='update.php?id=$row[0]'>Edit</a> | <a href='admin3.php?delete_id=$row[0]'>Hapus</a></td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <button onclick="showFunction()">Admin</button>
                                <?php
                                mysqli_close($con);
                                ?>

                                <?php
                                include "koneksi.php";
                                if (isset($_GET['delete_id'])) {
                                    $id_user = $_GET['delete_id'];
                                    $query = "DELETE FROM user_account WHERE id='$id_user'";
                                    mysqli_query($con, $query);
                                    echo "<meta http-equiv=Refresh content=0;url=admin3.php>";
                                }
                                ?>
                                
                            </div>
                            <div class="admin-data" id="admin-data" style="display: none;">
                                <?php
                                require('koneksi.php');
                                $result = mysqli_query($con, "SELECT * FROM admin_account");
                                $jumlah_record = mysqli_num_rows($result);
                                ?>

                                <h3>Daftar Admin</h3>
                                <table id="admindata" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_row($result)) {
                                            echo "<tr><td>$row[1]</td><td>$row[2]</td><td><a href='update.php?id=$row[0]'>Edit</a> | <a href='admin3.php?delete_id=$row[0]'>Hapus</a></td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <button onclick="showFunction()">User</button>
                                <?php
                                mysqli_close($con);
                                ?>

                                <?php
                                include "koneksi.php";
                                if (isset($_GET['delete_id'])) {
                                    $id_admin = $_GET['delete_id'];
                                    $query = "DELETE FROM admin_account WHERE id='$id_admin'";
                                    mysqli_query($con, $query);
                                    echo "<meta http-equiv=Refresh content=0;url=admin3.php>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; Tim Smart Lamp</p>
        <small>2023</small>
    </footer>

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
</body>
</html>