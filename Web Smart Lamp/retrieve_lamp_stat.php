<?php
// Include your database configuration file
require_once "dbconfig.php";

// Function to retrieve lamp statuses from the database
function retrieveLampStatuses()
{
    global $con; // Assuming $con is your database connection object

    try {
        $lampStatuses = [];

        // Fetch lamp statuses from the database
        $query = "SELECT no_lampu, status FROM manual_lamp";
        $stmt = $con->prepare($query);
        $stmt->execute();

        // Fetch all rows as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Populate the $lampStatuses array
        foreach ($result as $row) {
            $lampStatuses[$row['no_lampu']] = ($row['status'] == 1) ? 'On' : 'Off';
        }

        return $lampStatuses;
    } catch (PDOException $e) {
        // Handle any database connection errors
        echo "Error: " . $e->getMessage() . "<br>";
        return [];
    }
}

function getLampStatusFromStorage($lampNumber)
{
    global $con; // Assuming $con is your database connection object

    try {
        // Fetch the status of the specified lamp from the database
        $query = "SELECT status FROM manual_lamp WHERE no_lampu = :lampNumber";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':lampNumber', $lampNumber, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the status as an associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the result is not empty
        if ($result) {
            // Return the status ('On' if status is 1, 'Off' otherwise)
            return ($result['status'] == 1) ? 'On' : 'Off';
        } else {
            // If the lamp number is not found, return a default status or handle it accordingly
            return 'Unknown';
        }
    } catch (PDOException $e) {
        // Handle any database connection errors
        echo "Error: " . $e->getMessage() . "<br>";
        return 'Error';
    }
}

// Example usage:
//$lampStatuses = retrieveLampStatusesFromDB();

// You can now use the $lampStatuses array to access individual lamp statuses.
// For example, $lampStatuses[1] will give you the status of Lamp 1.
?>
