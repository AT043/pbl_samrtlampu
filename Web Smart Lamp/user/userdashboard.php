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
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard | SmartLamp</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/styles.css" />
      <style>
        .slave2-main {
          display: flex;
          width: 100%;
          font-size: 20px;
        }
        .slave2-sub1 {
          display: flex;
          flex: 50%;
          justify-content: center;
          /*margin: 50px;*/
        }
        .slave2-sub2 {
          display: flex;
          flex: 50%;
          justify-content: center;
          /*margin: 20px 10px;*/
        }


/*      @media (min-width: 768px) {
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
      <div class="container">
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar">

        </div>
        <!-- Content -->
        <div class="content">
          <div class="slave2-main">
              <div class="slave2-sub1">

              </div>
              <div class="slave2-sub2">

              </div>
          </div>
        </div>
      </div>
    </div>
    <script src="./assets/js/main.js"></script>
    <script type="text/javascript">
            function updateClock() {
            // Get current date and time
            var now = new Date();
            var datetime = now.toLocaleString();

            // Insert date and time into HTML
            document.getElementById("datetime").innerHTML = datetime;
        }
    </script>
    </body>
</html>
