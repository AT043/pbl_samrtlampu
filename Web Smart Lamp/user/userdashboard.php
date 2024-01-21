<?php  

// Lampirkan dbconfig  
require_once "../dbconfig.php";  

// Cek status login user  
if (!$person->isLoggedIn()) {  
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

          .dropbtn {
            background-color: #000d;
            color: white;
            padding: 5px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            margin: 0 auto;
          }

          .dropbtn:hover, .dropbtn:focus {
            background-color: #000f;
          }

          .dropdown {
            position: relative;
            display: inline-block;
          }

          .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
          }

          .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
          }

          .dropdown a:hover {background-color: #ddd;}

          .show {display: block;}

        </style>
    </head>
    <body>
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="navbar">
                <div class="nb-container">
                    <div class="nb-left">
                        <div class="nb-title">SmartLamp</div>
                        <!-- <button id="nb-toggle" class="nb-toggle">
                            <div class="nb-i-line"></div>
                            <div class="nb-i-line"></div>
                            <div class="nb-i-line"></div>
                        </button> -->
                    </div>
                    <div class="nb-right">
                            <div class="dropdown">
                                <div class="dropbtn" onclick="myFunction()" style="display: flex;">
                                    <img src="../assets/icons/user.svg" alt="user icon" class="user-img" width="20" height="20" />
                                    <h3 class="user-name"><?php echo $currentUser['username'] ?></h3>
                                </div>
                                <div id="myDropdown" class="dropdown-content">
                                    <a href="#">Edit User</a>
                                    <a href="../logout.php">Logout</a>
                                    <!-- <a href="#contact">Contact</a> -->
                                </div>
                            </div>
                        <h3 style="font-size: 22px;"><a href="../about.html">Tentang</a></h3>
                        <h3 style="font-size: 22px;"><a href="../help.html">Bantuan</a></h3>
                    </div>
                </div>
            </nav>
            <div class="container">
                <!-- Sidebar -->

                <!-- CONTENT -->
                <div class="content">
                    <div class="master">
                        <div class="slave">
                            <div class="lamp-mode-box">
                            <h3>Mode Manual</h3>
                            <form method="post" action="update_status.php" id="lampForm">
                                <?php for ($i = 1; $i <= 4; $i++) { ?>
                                    <div class="lamp-mode-box-m" id="lamp<?php echo $i; ?>Container">
                                        <span class="material-icons md-48 basecolor basecolor2">lightbulb</span>
                                        <p>Lampu <?php echo $i; ?></p>
                                        <label class="toggle">
                                            <input type="checkbox" id="lamp<?php echo $i; ?>Checkbox" class="lampCheckbox">
                                            <span class="slider"></span>
                                            <span class="labels" data-on="ON" data-off="OFF"></span>
                                        </label>
                                    </div>
                                <?php } ?>
                                <div class="manual-all-lamp">
                                    <h3>Semua Lampu</h3>
                                    <div class="all-lamp-btn">
                                        <button class="btn-all-lamp" type="button" id="btnOnAll" name="OnAll">ON</button>
                                        <button class="btn-all-lamp" type="button" id="btnOffAll" name="OffAll">OFF</button>
                                    </div>
                                </div>
                            </form>
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
                                                <span class="material-icons md-48 basecolor">lightbulb</span>
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
            // Get all toggle switches in Mode Manual
            var manualToggleSwitches = document.querySelectorAll('.lamp-mode-box input[type="checkbox"]');

            // Get the buttons for All ON and All OFF in Mode Manual
            var btnOnAllManual = document.querySelector('#btnOnAll');
            var btnOffAllManual = document.querySelector('#btnOffAll');

            // Add a click event listener to the ON button in Mode Manual
            btnOnAllManual.addEventListener('click', function () {
                manualToggleSwitches.forEach(function (toggleSwitch) {
                    toggleSwitch.checked = true;
                    var icon = toggleSwitch.closest('.lamp-mode-box-m').querySelector('.material-icons');
                    icon.style.color = 'yellow';
                });
            });

            // Add a click event listener to the OFF button in Mode Manual
            btnOffAllManual.addEventListener('click', function () {
                manualToggleSwitches.forEach(function (toggleSwitch) {
                    toggleSwitch.checked = false;
                    var icon = toggleSwitch.closest('.lamp-mode-box-m').querySelector('.material-icons');
                    icon.style.color = '#ccc';
                });
            });

            // Add a change event listener to each toggle switch in Mode Manual
            manualToggleSwitches.forEach(function (toggleSwitch) {
                toggleSwitch.addEventListener('change', function () {
                    var icon = this.closest('.lamp-mode-box-m').querySelector('.material-icons');
                    icon.style.color = this.checked ? 'yellow' : '#ccc';
                });
            });

            // Get the toggle switch in Mode Otomatis
            var autoToggleSwitch = document.querySelector('.auto-mode-switch input[type="checkbox"]');

            // Add a change event listener to the toggle switch in Mode Otomatis
            autoToggleSwitch.addEventListener('change', function () {
                var icon = this.closest('.auto-mode-switch-block').querySelector('.material-icons');
                icon.style.color = this.checked ? 'yellow' : '#ccc';

                // Execute the appropriate script based on the toggle state
                var scriptURL = this.checked ? "http://192.168.31.159/eksekusi-kode-A" : "http://192.168.31.159/eksekusi-kode-B";

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

            // Get the button for All ON in Mode Manual
            var btnOnAll = document.querySelector('#btnOnAll');

            // Add a change event listener to each toggle switch
            toggleSwitches.forEach(function (toggleSwitch) {
                toggleSwitch.addEventListener('change', function () {
                    // Get the icon element
                    var icon = this.closest('.lamp-mode-box-m, .auto-timer').querySelector('.material-icons');

                    // Change the color based on the toggle state
                    icon.style.color = this.checked ? 'yellow' : '#ccc';

                    // Execute the appropriate script based on the toggle state and lamp ID
                    var lampID = this.id.replace('lamp', ''); // Extract lamp ID
                    var scriptURL = this.checked ? "http://192.168.31.159/eksekusi-kode-A-" + lampID : "http://192.168.31.159/eksekusi-kode-B-" + lampID;

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

            // Add a click event listener to the ON button in Mode Manual
            btnOnAll.addEventListener('click', function () {
                toggleSwitches.forEach(function (toggleSwitch) {
                    // Set the toggle state to checked
                    toggleSwitch.checked = true;

                    // Get the icon element
                    var icon = toggleSwitch.closest('.lamp-mode-box-m, .auto-timer').querySelector('.material-icons');
                    // Change the color based on the toggle state
                    icon.style.color = 'yellow';

                    // Execute the script for turning on all lamps
                    var lampID = toggleSwitch.id.replace('lamp', ''); // Extract lamp ID
                    var scriptURL = "http://192.168.31.159/eksekusi-kode-A-" + lampID : "http://192.168.31.159/eksekusi-kode-B-" + lampID;

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
    <script>
        function myFunction() {
            var dropdownContent = document.getElementById("myDropdown");
            dropdownContent.classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
    
</html>
