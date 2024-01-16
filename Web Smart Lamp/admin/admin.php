<?php  

// Lampirkan dbconfig  
require_once "../dbconfig.php";  

// Cek status login user  
if (!$person->isLoggedIn()) {  
    header("location: ../login.php"); //Redirect ke halaman login  
}  

// Ambil data user saat ini  
$currentUser = $person->getUser();  
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
                                <img src="../assets/icons/edit.svg" alt="search icon" />
                                History
                            </a>
                            <a class="sb-item" href="admin4.php">
                                <img src="../assets/icons/edit.svg" alt="products icon" />
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
                                                <td colspan="2"><span class="material-icons md-48 basecolor basecolor2">lightbulb</span></td>
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
        document.addEventListener('DOMContentLoaded', function () {
            // Function to initialize lamp status from local storage
            function initializeLampStatus() {
                for (let i = 1; i <= 4; i++) {
                    const lampStatus = localStorage.getItem(`lamp${i}Status`);
                    if (lampStatus !== null) {
                        document.getElementById(`lamp${i}Checkbox`).checked = lampStatus === '1';
                        updateStatus(document.getElementById(`lamp${i}Checkbox`));
                    }
                }
            }

            // Get all toggle switches in Mode Manual
            var manualToggleSwitches = document.querySelectorAll('.lampCheckbox');

            // Get the buttons for All ON and All OFF in Mode Manual
            var btnOnAllManual = document.querySelector('#btnOnAll');
            var btnOffAllManual = document.querySelector('#btnOffAll');

            // Initialize lamp status from local storage
            initializeLampStatus();

            // Add a click event listener to the ON button in Mode Manual
            btnOnAllManual.addEventListener('click', function () {
                manualToggleSwitches.forEach(function (toggleSwitch) {
                    toggleSwitch.checked = true;
                    updateStatus(toggleSwitch);
                });
            });

            // Add a click event listener to the OFF button in Mode Manual
            btnOffAllManual.addEventListener('click', function () {
                manualToggleSwitches.forEach(function (toggleSwitch) {
                    toggleSwitch.checked = false;
                    updateStatus(toggleSwitch);
                });
            });

            // Add a change event listener to each toggle switch in Mode Manual
            manualToggleSwitches.forEach(function (toggleSwitch) {
                toggleSwitch.addEventListener('change', function () {
                    updateStatus(this);
                });
            });

            // Add a click event listener to the ON button in Mode Semua Lampu
            btnOnAllManual.addEventListener('click', function () {
                updateStatusForAll(1); // 1 represents ON
            });

            // Add a click event listener to the OFF button in Mode Semua Lampu
            btnOffAllManual.addEventListener('click', function () {
                updateStatusForAll(0); // 0 represents OFF
            });

            // Function to update status for a specific lamp
            function updateStatus(element) {
                var lampNumber = element.id.replace('lamp', '');
                var status = element.checked ? 1 : 0;

                // Update local storage
                localStorage.setItem(`lamp${lampNumber}Status`, status);

                // You can add an AJAX call here to update the database
                // Example: sendUpdateToServer(lampNumber, status);
            }

            // Function to update status for all lamps
            function updateStatusForAll(status) {
                manualToggleSwitches.forEach(function (toggleSwitch) {
                    toggleSwitch.checked = status === 1;
                    updateStatus(toggleSwitch);
                });
            }

            // You can add an AJAX function to send updates to the server if needed
            function sendUpdateToServer(lampNumber, status) {
                // Example AJAX call
                fetch('update_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        lampNumber: lampNumber,
                        status: status,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            }
        });
    </script>

</html>
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
        var scriptURL = "http://192.168.31.159/eksekusi-kode-A-" + lampID;

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

btnOffAll.addEventListener('click', function () {
    toggleSwitches.forEach(function (toggleSwitch) {
        // Set the toggle state to unchecked
        toggleSwitch.checked = false;

        // Get the icon element
        var icon = toggleSwitch.closest('.lamp-mode-box-m, .auto-timer').querySelector('.material-icons');
        // Change the color based on the toggle state
        icon.style.color = '#ccc';

        // Execute the script for turning off all lamps
        var lampID = toggleSwitch.id.replace('lamp', ''); // Extract lamp ID
        var scriptURL = "http://192.168.31.159/eksekusi-kode-B-" + lampID;

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
