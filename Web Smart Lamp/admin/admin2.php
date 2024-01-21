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
                font-size: 18px; /* Adjust the font size as needed */
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

            .btn-permission {
                width: 60px;
                background-color: green;
                color: white;
                padding: 5px;
                margin: 0 10px;
            }

            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
          }

            .modal-content {
              background-color: #fefefe;
              margin: 15% auto;
              padding: 20px;
              border: 1px solid #888;
              width: 50%; /* Adjust the width as needed */
              display: flex;
              flex-direction: column; /* Set the layout to top-bottom */
            }

            .modal-content label,
            .modal-content input {
              margin-bottom: 10px;
            }

          .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
          }

          .close:hover,
          .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
                                <div class="user-data" id="user-data">
                                    <?php
                                    //$auth = new Auth($con);
                                    $data = $admin->getAllUsersAndAdmins();
                                    $users = $data['users'];
                                    ?>
                                    <h3>Daftar User</h3>
                                    <table id="userdata" class="table table-striped table-bordered" style="width:100%;">
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
                                                echo "<tr><td>{$user['username']}</td><td>{$user['email']}</td></td><td><a class='btn-edit' onclick='openModal()'>Edit</a> <a class='btn-delete' href='admin2.php?delete_id={$user['username']}'>Hapus</a><a class='btn-permission' href='admin2.php?jadiadmin_id={$user['username']}'>Jadi Admin</a></td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <button onclick="showFunction()">Admin</button>
                                </div>

                                <!-- The Modal -->
                                <div id="editModal" class="modal">
                                  <!-- Modal content -->
                                  <div class="modal-content">
                                    <span class="close" onclick="closeModal()">&times;</span>
                                    <form id="editForm">
                                      <label for="password">Password:</label>
                                      <input type="password" id="password" name="password" required>
                                      <br>
                                      <label for="username">Username:</label>
                                      <input type="text" id="username" name="username" required>

                                      <button type="button" onclick="submitForm()">Submit</button>
                                    </form>
                                  </div>
                                </div>

                                <div class="admin-data" id="admin-data" style="display: none;">
                                    <?php
                                    $admins = $data['admins'];
                                    ?>
                                    <h3>Daftar Admin</h3>
                                    <table id="admindata" class="table table-striped table-bordered" style="width:100%;">
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
                                                echo "<tr><td>{$admin['username']}</td><td>{$admin['email']}</td><td><a class='btn-edit' href='update.php?id={$admin['id']}'>Edit</a> <a class='btn-delete' href='admin2.php?delete_id={$admin['username']}'>Hapus</a><a class='btn-permission' href='admin2.php?jadiuser_id={$admin['username']}'>Jadi User</a></td></tr>";
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
        ?>
        <?php
        if (isset($_GET['delete_id'])) {
            $usernameToDelete = $_GET['delete_id'];

            // Use a prepared statement to avoid SQL injection
            $deleteStatement = $con->prepare("DELETE FROM users WHERE username = :username");
            $deleteStatement->bindParam(":username", $usernameToDelete);

            // Execute the query
            if ($deleteStatement->execute()) {
                echo "<script>alert('Yakin mau dihapus?')</script>";
                echo "<meta http-equiv=Refresh content=0;url=../admin/admin2.php>";
            } else {
                echo "Error deleting user.";
            }
        }
        ?>

        <?php 
        if(isset($_GET['jadiadmin_id'])) {
            $userJadiAdmin = $_GET['jadiadmin_id'];

            $mauJadiAdmin = $con->prepare("UPDATE users SET permissions = 1 WHERE username = :username");
            $mauJadiAdmin->bindParam(":username", $userJadiAdmin);

            if ($mauJadiAdmin->execute()) {
                //echo "<script>alert('Yakin mau dihapus?')</script>";
                echo "<meta http-equiv=Refresh content=0;url=../admin/admin2.php>";
            } else {
                echo "Error Jadikan User Sebagai Admin.";
            }
        }
        ?>

        <?php 
        if(isset($_GET['jadiuser_id'])){
            $adminJadiUser = $_GET['jadiuser_id'];

            // Assuming $con is your database connection
            $query = "SELECT * FROM users WHERE username = :username";
            $stmt = $con->prepare($query);
            $stmt->bindParam(":username", $adminJadiUser);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($currentUser['username'] === 'admine1') {
                $yahJadiUser = $con->prepare("UPDATE users SET permissions = 0 WHERE username = :username");
                $yahJadiUser->bindParam(":username", $adminJadiUser);

                if ($yahJadiUser->execute()) {
                    //echo "<script>alert('Yakin mau dihapus?')</script>";
                    echo "<meta http-equiv=Refresh content=0;url=../admin/admin2.php>";
                } else {
                    echo "Error Jadikan User Sebagai Admin.";
                }
            } else {
                echo "<script>alert('Maaf Anda tidak bisa!')</script>";
            }
        }
        ?>

    </body>
    <script src="../assets/js/main.js"></script>
    <script type="text/javascript">
        function updateClock() {
            // Get current date and time
            var now = new Date();

            // Extract hours, minutes, and seconds
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();

            // Add leading zero if needed
            hours = (hours < 10) ? "0" + hours : hours;
            minutes = (minutes < 10) ? "0" + minutes : minutes;
            seconds = (seconds < 10) ? "0" + seconds : seconds;

            // Concatenate hours, minutes, and seconds
            var time = hours + ":" + minutes + ":" + seconds;

            // Insert time into HTML
            document.getElementById("time").innerHTML = time;
        }

        // Update the clock every second (1000 milliseconds)
        setInterval(updateClock, 1000);
    </script>
    <script type="text/javascript">
        function updateDate() {
            // Get current date
            var now = new Date();

            // Extract year, month, and day
            var year = now.getFullYear();
            var month = now.getMonth() + 1; // Months are zero-based
            var day = now.getDate();

            // Add leading zero if needed
            month = (month < 10) ? "0" + month : month;
            day = (day < 10) ? "0" + day : day;

            // Concatenate year, month, and day
            var date = year + "-" + month + "-" + day;

            // Insert date into HTML
            document.getElementById("date").innerHTML = date;
        }

        // Update the date every second (1000 milliseconds)
        setInterval(updateDate, 1000);
    </script>
    <script>
        jQuery(document).ready(function($) {
            $('#userdata').DataTable({
                "lengthMenu": [2, 4, 6, 8], // Set the available choices for the number of rows per page
                "pageLength": 8  // Set the default number of rows per page
            });
        });
    </script>
    <script>
        jQuery(document).ready(function($) {
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

<script>
  // Open the modal
  function openModal() {
    document.getElementById('editModal').style.display = 'block';
  }

  // Close the modal
  function closeModal() {
    document.getElementById('editModal').style.display = 'none';
  }

  // Submit the form (you may need to adjust this based on your needs)
  function submitForm() {
    // Get values from the form
    var password = document.getElementById('password').value;
    var username = document.getElementById('username').value;

    // Perform actions with the values (you may need to customize this part)
    console.log('Password:', password);
    console.log('Username:', username);

    // Close the modal (you can adjust this based on your needs)
    closeModal();
  }
</script>
</html>
