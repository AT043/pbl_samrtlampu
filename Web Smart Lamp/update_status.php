<?php
// Include your database configuration file
require_once "dbconfig.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Array to store lamp statuses
    $lampStatuses = [];

    // Iterate through lamps
    for ($i = 1; $i <= 4; $i++) {
        // Construct the checkbox name dynamically
        $checkboxName = "lamp{$i}Checkbox";

        // Assuming lampStatus is 1 when the checkbox is checked, and 0 when it's unchecked
        $lampStatus = isset($_POST[$checkboxName]) && $_POST[$checkboxName] === "On" ? 1 : 0;

        // Store the lamp status in the array
        $lampStatuses[$i] = $lampStatus;

        try {
            // Prepare the update query
            $query = "UPDATE manual_lamp SET status = :status, waktu = NOW() WHERE no_lampu = :lamp";
            $stmt = $con->prepare($query);

            // Bind parameters
            $stmt->bindParam(':status', $lampStatus, PDO::PARAM_INT);
            $stmt->bindParam(':lamp', $i, PDO::PARAM_INT);

            // Execute the statement
            if ($stmt->execute()) {
                    //echo "Update successful for Lamp {$i}. Status set to {$lampStatus}.<br>";
                    $userData = $person->getUser();
                if ($userData['permissions'] == 1 && $userData['permissions'] == 2) {
                    // Admin
                    header("location: admin/admin.php");
                    $person->insertpersonHistory();
                } else {
                    // User
                    header("location: user/userdashboard.php");
                    $person->insertpersonHistory();
                }
            } else {
                //echo "Error updating data for Lamp {$i}: " . $stmt->errorInfo()[2] . "<br>";
                $userData = $person->getUser();
                if ($userData['permissions'] == 1 && $userData['permissions'] == 2) {
                    // Admin
                    header("location: admin/admin.php");
                    $person->insertpersonHistory();
                } else {
                    // User
                    header("location: user/userdashboard.php");
                    $person->insertpersonHistory();
                }
            }
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage() . "<br>";
        }
    }

    // You can now use $lampStatuses array to access individual lamp statuses if needed.
}
?>
