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
                                <div class="lamp-mode-box-m">
                                    <span class="material-icons md-48 basecolor">lightbulb</span>
                                    <p>Lampu 1</p>
                                    <label class="toggle">
                                        <input type="checkbox">
                                        <span class="slider"></span>
                                        <span class="labels" data-on="ON" data-off="OFF"></span>
                                    </label>
                                </div>
                                <div class="lamp-mode-box-m">
                                    <span class="material-icons md-48 basecolor">lightbulb</span>
                                    <p>Lampu 2</p>
                                    <label class="toggle">
                                        <input type="checkbox">
                                        <span class="slider"></span>
                                        <span class="labels" data-on="ON" data-off="OFF"></span>
                                    </label>
                                </div>
                                <div class="lamp-mode-box-m">
                                    <span class="material-icons md-48 basecolor">lightbulb</span>
                                    <p>Lampu 3</p>
                                    <label class="toggle">
                                        <input type="checkbox">
                                        <span class="slider"></span>
                                        <span class="labels" data-on="ON" data-off="OFF"></span>
                                    </label>
                                </div>
                                <div class="lamp-mode-box-m">
                                    <span class="material-icons md-48 basecolor">lightbulb</span>
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
            // Get all toggle switches
            var toggleSwitches = document.querySelectorAll('.toggle input[type="checkbox"]');

            // Add a change event listener to each toggle switch
            toggleSwitches.forEach(function (toggleSwitch) {
                toggleSwitch.addEventListener('change', function () {
                    // Get the icon element
                    var icon = this.closest('.lamp-mode-box-m, .auto-timer').querySelector('.material-icons');

                    // Change the color based on the toggle state
                    icon.style.color = this.checked ? ' yellow ' : '#ccc';
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
