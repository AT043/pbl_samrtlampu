<?php
// update_status.php
require_once 'dbconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process data from the form
    for ($i = 1; $i <= 4; $i++) {
        $lampStatus = isset($_POST["lamp" . $i . "Checkbox"]) ? 1 : 0;
        updateManualLampStatus($i, $lampStatus);
    }

    // Process data for "Semua Lampu" buttons
    if (isset($_POST["OnAll"])) {
        updateAllLampStatus(1); // 1 represents ON
    } elseif (isset($_POST["OffAll"])) {
        updateAllLampStatus(0); // 0 represents OFF
    }

    // Redirect back to the main page after processing
    header("Location: userdashboard.php");
    exit();
}

// Function to update status for a specific lamp
function updateManualLampStatus($lampNumber, $status) {
    global $con;

    // Use a prepared statement to avoid SQL injection
    $updateStatement = $con->prepare("UPDATE manual_lamp SET waktu = NOW(), status = :status WHERE no_lampu = :lampNumber");
    $updateStatement->bindParam(":status", $status);
    $updateStatement->bindParam(":lampNumber", $lampNumber);

    // Execute the query
    $updateStatement->execute();
}

// Function to update status for all lamps
function updateAllLampStatus($status) {
    for ($i = 1; $i <= 4; $i++) {
        updateManualLampStatus($i, $status);
    }
}
?>
