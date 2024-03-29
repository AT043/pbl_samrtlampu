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
                                    <!-- <a href="#">Edit User</a> -->
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
<!-- 
                                <div class="manual-all-lamp">
                                    <h3>Semua Lampu</h3>
                                    <div class="all-lamp-btn">
                                        <button class="btn-all-lamp" type="button" id="btnOnAll" name="OnAll" onclick="submitForm()">ON</button>
                                        <button class="btn-all-lamp" type="button" id="btnOffAll" name="OffAll" onclick="submitForm()">OFF</button>
                                    </div>
                                </div> -->
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
<!--                                             <tr>
                                                <?php $stime = $lamp->getScheduleData(); ?>
                                                <td><?php echo $stime['mulai'];?></td>
                                                <td><?php echo $stime['selesai'];?></td>
                                            </tr> -->
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
                                            <form action="http://192.168.157.3/toggle-auto-mode" method="post">
                                                <!-- <span class="material-icons md-48 basecolor basecolor2">lightbulb</span> -->
                                                <label class="toggle">
                                                    <!-- <input type="checkbox" id="autoToggleon" name="autoToggleon"> -->
                                                    <!-- <span class="slider"></span>
                                                    <span class="labels" data-on="ON" data-off="OFF"></span> -->
                                                    <input type="submit" id="autoToggleon" name="autoToggleon" value="on">ON</input>
                                                </label>
                                            </form>
                                            <form action="http://192.168.157.3/toggle-auto-mode" method="post">
                                                <label class="toggle">
                                                    <!-- <input type="checkbox" id="autoToggleoff" name="autoToggleoff"> -->
                                                    <!-- <span class="slider"></span>
                                                    <span class="labels" data-on="ON" data-off="OFF"></span> -->
                                                    <input type="submit" id="autoToggleoff" name="autoToggleoff" value="on">OFF</input>
                                                </label>
                                            </form>
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
    <script src="../assets/js/time.js"></script>
    
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
                    "http://192.168.157.3/eksekusi-kode-E",
                    "http://192.168.157.3/eksekusi-kode-G"
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
                    "http://192.168.157.3/eksekusi-kode-F",
                    "http://192.168.157.3/eksekusi-kode-H"
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
    var statusToUpdate = 0;    
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
                        "http://192.168.157.3/eksekusi-kode-E",
                        "http://192.168.157.3/eksekusi-kode-G"
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
                } else if(currentTime >= endTime && currentDate === dateOn){
                    // Set the new lamp element content and style
                    newLampElement.textContent = 'lightbulb';
                    newLampElement.style.color = '#ccc';

                    var scriptURLsOff = [
                        "http://192.168.157.3/eksekusi-kode-B",
                        "http://192.168.157.3/eksekusi-kode-D",
                        "http://192.168.157.3/eksekusi-kode-F",
                        "http://192.168.157.3/eksekusi-kode-H"
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

    function checkForUpdateScript() {
        var checkScheduleUpdate = <?php echo json_encode($lamp->getScheduleData()); ?>;
        if (checkScheduleUpdate) {
            var start = checkScheduleUpdate['mulai'];
            start = start.replace(/:/g, '').padStart(6, '0');

            var current = new Date().toLocaleTimeString('en-US', { hour12: false });
            current = current.replace(/:/g, '').padStart(6, '0');

            console.log("Start Time:", start);

            //var statusToUpdate = 0;
            if (current >= start) {
                checkAndExecuteScripts();
                setInterval(checkAndExecuteScripts, 30000);
            } else {
                console.log('Stop');
            }
        } else {
            console.log('Stop');
        }
        // Set the interval here
        //setInterval(checkForUpdateScript, 30000);
    }

    setInterval(checkForUpdateScript, 30000);

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
        document.addEventListener('DOMContentLoaded', function () {
            
            var toggleSwitch = document.getElementById('lamp4Checkbox');

            toggleSwitch.addEventListener('change', function () {

                // Execute the appropriate script based on the toggle state
                var scriptURL = this.checked ? "http://192.168.157.3/eksekusi-kode-G" : "http://192.168.157.3/eksekusi-kode-H";

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
            document
        }
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

    <script>
        function submitForm() {
            document.getElementById("LampStatus").submit();
            document
        }
    </script>
    
</html>
