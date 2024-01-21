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
                <div class="content">
                    <div class="master">
                        <div class="slave">
                            <div class="lamp-mode-box">
                            <h3>Mode Manual</h3>
                            <form method="post" action="../update_status.php" id="LampStatus">
                                <?php for ($i = 1; $i <= 4; $i++) { ?>
                                    <div class="lamp-mode-box-m" id="lamp<?php echo $i; ?>Container">
                                        <?php
                                        $lampNumber = $i; // Adjust this based on the lamp number
                                        $lampStatus = $lamp->getLampStatusFromStorage($lampNumber);
                                        ?>
                                        <span class="material-icons md-48" style="color: <?php echo ($lampStatus === 'On') ? 'yellow' : '#ccc'; ?>">lightbulb</span>
                                        <p>Lampu <?php echo $i; ?></p>
                                        <label class="toggle">
                                            <input type="checkbox" id="lamp<?php echo $i; ?>Checkbox" name="lamp<?php echo $i; ?>Checkbox" class="lampCheckbox" value="On" onchange="submitForm()" <?php if ($lampStatus === 'On') echo 'checked'; ?>>
                                            <span class="slider"></span>
                                            <span class="labels" data-on="ON" data-off="OFF"></span>
                                        </label>
                                    </div>
                                <?php } ?>

                                <div class="manual-all-lamp">
                                    <h3>Semua Lampu</h3>
                                    <div class="all-lamp-btn">
                                        <button class="btn-all-lamp" type="button" id="btnOnAll" name="OnAll" onclick="submitForm()">ON</button>
                                        <button class="btn-all-lamp" type="button" id="btnOffAll" name="OffAll" onclick="submitForm()">OFF</button>
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
                                            <form method="post" action="lamp_schedule.php">
                                            <tr>
                                                <td><input type="time" name="startTime"></td>
                                                <td><input type="time" name="endTime"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><button type="submit" name="submit" class="btn-all-lamp" id="button-schedule">Simpan</button></td>
                                            </tr>
                                            </form>
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
            });
          });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            var btnOnAll = document.getElementById('btnOnAll');

            btnOnAll.addEventListener('click', function () {
                // Execute the appropriate script based on the toggle state
                var scriptURLs = [
                    "http://192.168.157.3/eksekusi-kode-A",
                    "http://192.168.157.3/eksekusi-kode-C",
                    "http://192.168.157.3/eksekusi-kode-E"
                ];

                // Use Promise.all to wait for all fetch requests to complete
                Promise.all(scriptURLs.map(url => fetch(url)))
                    .then(responses => Promise.all(responses.map(response => response.json())))
                    .then(data => {
                        console.log("All scripts executed successfully:", data);
                    })
                    .catch(error => {
                        console.error("Error executing scripts:", error);
                    });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            var btnOnAll = document.getElementById('btnOffAll');

            btnOnAll.addEventListener('click', function () {
                // Execute the appropriate script based on the toggle state
                var scriptURLs = [
                    "http://192.168.157.3/eksekusi-kode-B",
                    "http://192.168.157.3/eksekusi-kode-D",
                    "http://192.168.157.3/eksekusi-kode-F"
                ];

                // Use Promise.all to wait for all fetch requests to complete
                Promise.all(scriptURLs.map(url => fetch(url)))
                    .then(responses => Promise.all(responses.map(response => response.json())))
                    .then(data => {
                        console.log("All scripts executed successfully:", data);
                    })
                    .catch(error => {
                        console.error("Error executing scripts:", error);
                    });
            });
        });
    </script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Function to check and execute scripts based on scheduling data
    
    // Status variable to be updated in the scheduling table
    statusToUpdate = 0;
    function checkAndExecuteScripts() {
        var scheduleData = <?php echo json_encode($lamp->getScheduleData()); ?>;

        if (scheduleData) {
            var startTime = scheduleData['mulai'];
            var endTime = scheduleData['selesai'];
            var dateOn = scheduleData['tanggal'];

            // Remove colons and format with leading zeros
            startTime = startTime.replace(/:/g, '').padStart(6, '0');
            endTime = endTime.replace(/:/g, '').padStart(6, '0');

            // Check if the current time is within the scheduled time range
            var currentTime = new Date().toLocaleTimeString('en-US', { hour12: false });
            // Remove colons and format with leading zeros
            currentTime = currentTime.replace(/:/g, '').padStart(6, '0');

            console.log("Start Time:", startTime);
            console.log("End Time:", endTime);
            console.log("Current Time:", currentTime);

            var currentDateObject = new Date();

            // Extract year, month, and day components
            var year = currentDateObject.getFullYear();
            var month = (currentDateObject.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-based
            var day = currentDateObject.getDate().toString().padStart(2, '0');

            // Format the date
            var currentDate = year + month + day;
            dateOn = dateOn.replace(/-/g, '').padStart(6, '0');
            console.log(currentDate); // Output: yyyy:mm:dd
            console.log(dateOn);

            // Get the lamp container element
            var lampContainer = document.querySelector('.auto-schedul .material-icons.basecolor2');

            // Create a new lamp element
            var newLampElement = document.createElement('span');
            newLampElement.className = 'material-icons md-48 basecolor basecolor2';

            if (currentTime >= startTime && currentTime <= endTime && currentDate === dateOn) {
                // Show an alert indicating that scheduling has started
                // alert('Scheduling has started!');

                // Set the new lamp element content and style
                newLampElement.textContent = 'lightbulb';
                newLampElement.style.color = 'yellow';

                // Execute the appropriate script based on the toggle state
                var scriptURLsOn = [
                    "http://192.168.157.3/eksekusi-kode-A",
                    "http://192.168.157.3/eksekusi-kode-C",
                    "http://192.168.157.3/eksekusi-kode-E"
                ];

                // Update status variable to 1
                statusToUpdate = 1;

                // Use Promise.all to wait for all fetch requests to complete
                Promise.all(scriptURLsOn.map(url => fetch(url)))
                    .then(responses => Promise.all(responses.map(response => response.json())))
                    .then(data => {
                        console.log("All scripts executed successfully:", data);
                    })
                    .catch(error => {
                        console.error("Error executing scripts:", error);
                    });
            } else {
                // Set the new lamp element content and style
                newLampElement.textContent = 'lightbulb';
                newLampElement.style.color = '#ccc';

                var scriptURLsOff = [
                    "http://192.168.157.3/eksekusi-kode-B",
                    "http://192.168.157.3/eksekusi-kode-D",
                    "http://192.168.157.3/eksekusi-kode-F"
                ];

                // Update status variable to 0
                statusToUpdate = 0;

                // Use Promise.all to wait for all fetch requests to complete
                Promise.all(scriptURLsOff.map(url => fetch(url)))
                    .then(responses => Promise.all(responses.map(response => response.json())))
                    .then(data => {
                        console.log("All scripts executed successfully:", data);
                    })
                    .catch(error => {
                        console.error("Error executing scripts:", error);
                    });
            }

            // Update the status in the scheduling table
            fetch('../schedule_statud.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    status: statusToUpdate,
                    // Add other data to send to the server if needed
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Status updated successfully:', data);
            })
            .catch(error => {
                console.error('Error updating status:', error);
            });

            // Replace the existing lamp element with the new one
            lampContainer.innerHTML = '';
            lampContainer.appendChild(newLampElement);
        } else {
            console.error("Error fetching scheduling data.");
        }
    }

    // Check and execute scripts every 30 seconds
    if (statusToUpdate === 1) {
        setTimeout(function() {
            setInterval(checkAndExecuteScripts, 30000);
        }, 0);
    } else {
        console.log('Stop');
    }
});
</script>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            var toggleSwitch = document.getElementById('lamp1Checkbox');

            toggleSwitch.addEventListener('change', function () {

                // Execute the appropriate script based on the toggle state
                var scriptURL = this.checked ? "http://192.168.157.3/eksekusi-kode-A" : "http://192.168.157.3/eksekusi-kode-B";
                // var scriptURL = this.checked ? "http://192.168.157.3/eksekusi-kode-C" : "http://192.168.157.3/eksekusi-kode-D";

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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            var toggleSwitch = document.getElementById('lamp2Checkbox');

            toggleSwitch.addEventListener('change', function () {

                // Execute the appropriate script based on the toggle state
                var scriptURL = this.checked ? "http://192.168.157.3/eksekusi-kode-C" : "http://192.168.157.3/eksekusi-kode-D";
                // var scriptURL = this.checked ? "http://192.168.157.3/eksekusi-kode-C" : "http://192.168.157.3/eksekusi-kode-D";

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

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            var toggleSwitch = document.getElementById('lamp3Checkbox');

            toggleSwitch.addEventListener('change', function () {

                // Execute the appropriate script based on the toggle state
                var scriptURL = this.checked ? "http://192.168.157.3/eksekusi-kode-E" : "http://192.168.157.3/eksekusi-kode-F";

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
    <script>
        function submitForm() {
            document.getElementById("LampStatus").submit();
        }
    </script>
</html>

