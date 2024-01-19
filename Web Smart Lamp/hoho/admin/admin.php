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
                <div class="content">
                    <div class="master">
                        <div class="slave">
                            <div class="lamp-mode-box">
                            <h3>Mode Manual</h3>
                                <div class="lamp-mode-box-m">
                                    <span class="material-icons md-48 basecolor basecolor2">lightbulb</span>
                                    <p>Lampu 1</p>
                                    <label class="toggle">
                                        <input type="checkbox">
                                        <span class="slider"></span>
                                        <span class="labels" data-on="ON" data-off="OFF"></span>
                                    </label>
                                </div>
                                <div class="lamp-mode-box-m">
                                    <span class="material-icons md-48 basecolor basecolor2">lightbulb</span>
                                    <p>Lampu 2</p>
                                    <label class="toggle" id="kodeBButton">
                                        <input type="checkbox">
                                        <span class="slider"></span>
                                        <span class="labels" data-on="ON" data-off="OFF"></span>
                                    </label>
                                </div>
                                <div class="lamp-mode-box-m">
                                    <span class="material-icons md-48 basecolor basecolor2">lightbulb</span>
                                    <p>Lampu 3</p>
                                    <label class="toggle">
                                        <input type="checkbox">
                                        <span class="slider"></span>
                                        <span class="labels" data-on="ON" data-off="OFF"></span>
                                    </label>
                                </div>
                                <div class="lamp-mode-box-m">
                                    <span class="material-icons md-48 basecolor basecolor2">lightbulb</span>
                                    <p>Lampu 4</p>
                                    <label class="toggle">
                                        <input type="checkbox">
                                        <span class="slider"></span>
                                        <span class="labels" data-on="ON" data-off="OFF"></span>
                                    </label>
                                </div>
                                <div class="manual-all-lamp">
                                    <h3>Semua Lampu</h3>
                                    <div class="all-lamp-btn">
                                        <button class="btn-all-lamp" type="submit" name="OnAll">ON</button>
                                        <button class="btn-all-lamp" type="submit" name="OffAll">OFF</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="slave2">
                            <div class="auto-lamp-mode">
                                <div class="auto-lamp-block">
                                    <div class="auto-schedul">
                                        <h3>Mode Terjadwal</h3>
                                        <table>
                                            <tr>
                                                <td colspan="2">Waktu Sekarang</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><p id="datetime"></p></td>
                                            </tr>
                                            <tr>
                                                <td>Waktu Mulai</td>
                                                <td>Waktu Selesai</td>
                                            </tr>
                                            <tr>
                                                <td><input type="time" name="startTime"></td>
                                                <td><input type="time" name="endTime"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><button type="submit" name="submit" class="btn-all-lamp">Simpan</button></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="auto-timer">
                                        <h3>Mode Otomatis</h3>
                                        <div class="auto-mode-switch">
                                            <div class="auto-mode-switch-block">
                                                <span class="material-icons md-48 basecolor basecolor2">lightbulb</span>
                                                <label class="toggle">
                                                    <input type="checkbox">
                                                    <span class="slider"></span>
                                                    <span class="labels" data-on="ON" data-off="OFF"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </body>
    <script src="../assets/js/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get all toggle switches
            var toggleSwitches = document.querySelectorAll('.toggle input[type="checkbox"]');

            // Get the buttons for All ON and All OFF
            var btnOnAll = document.querySelector('button[name="OnAll"]');
            var btnOffAll = document.querySelector('button[name="OffAll"]');

            // Add a click event listener to the ON button
            btnOnAll.addEventListener('click', function () {
                toggleSwitches.forEach(function (toggleSwitch) {
                    // Set the toggle state to checked
                    toggleSwitch.checked = true;

                    // Get the icon element
                    var icon = toggleSwitch.closest('.lamp-mode-box-m, .auto-timer').querySelector('.material-icons');
                    // Change the color based on the toggle state
                    icon.style.color = 'yellow';
                });
            });

            // Add a click event listener to the OFF button
            btnOffAll.addEventListener('click', function () {
                toggleSwitches.forEach(function (toggleSwitch) {
                    // Set the toggle state to unchecked
                    toggleSwitch.checked = false;

                    // Get the icon element
                    var icon = toggleSwitch.closest('.lamp-mode-box-m, .auto-timer').querySelector('.material-icons');
                    // Change the color based on the toggle state
                    icon.style.color = '#ccc';
                });
            });

            // Add a change event listener to each toggle switch
            toggleSwitches.forEach(function (toggleSwitch) {
                toggleSwitch.addEventListener('change', function () {
                    // Get the icon element
                    var icon = this.closest('.lamp-mode-box-m, .auto-timer').querySelector('.material-icons');

                    // Change the color based on the toggle state
                    icon.style.color = this.checked ? 'yellow' : '#ccc';
                });
            });
        });
    </script>

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
        document.addEventListener('DOMContentLoaded', function () {
          var checkboxClickCount = 0;
          var checkboxClickStartTime;

          // Get all toggle switches
          var toggleSwitches = document.querySelectorAll('.toggle input[type="checkbox"]');

          // Add a click event listener to each toggle switch
          toggleSwitches.forEach(function (toggleSwitch) {
            toggleSwitch.addEventListener('click', function () {
              // Check if it's the first click or if the time difference is more than one second
              var currentTime = new Date().getTime();
              if (!checkboxClickStartTime || currentTime - checkboxClickStartTime > 3000) {
                checkboxClickCount = 1;
                checkboxClickStartTime = currentTime;
              } else {
                checkboxClickCount++;
              }

              // Check if the click count exceeds the threshold
              if (checkboxClickCount >= 5) {
                // Redirect to logout page or trigger your logout mechanism
                window.location.href = '../logout.php';
                alert('Too many click');
              }

              // Get the icon element
              var icon = this.closest('.lamp-mode-box-m, .auto-timer').querySelector('.material-icons');

              // Change the color based on the toggle state
              icon.style.color = this.checked ? 'yellow' : '#ccc';
            });
          });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get all toggle switches
            var toggleSwitches = document.querySelectorAll('.toggle input[type="checkbox"]');

            // Add a change event listener to each toggle switch
            toggleSwitches.forEach(function (toggleSwitch) {
                toggleSwitch.addEventListener('change', function () {
                    // Get the icon element
                    var icon = this.closest('.lamp-mode-box-m, .auto-timer').querySelector('.material-icons');

                    // Change the color based on the toggle state
                    icon.style.color = this.checked ? 'yellow' : '#ccc';

                    // Execute the appropriate script based on the toggle state
                    var scriptURL = this.checked ? "http://192.168.157.3/eksekusi-kode-A" : "http://192.168.157.3/eksekusi-kode-B";

                    fetch(scriptURL)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log("Script berhasil dijalankan:", data);
                        })
                        .catch(error => {
                            console.error("Ada kesalahan:", error);
                        });
                });
            });
        });
    </script>

</html>
