<?php

require_once 'dbconfig.php';


// Check if the data is sent as JSON
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

if ($input !== null) {
    // Extract data from the JSON input
    $status = $input['status'];
    // Add other data extraction if needed

    try {
        // Prepare the update query
        $query = "UPDATE scheduling SET status = :status";
        $stmt = $con->prepare($query);

        // Bind parameters
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Status updated successfully.'];
            echo json_encode($response);
        } else {
            $response = ['success' => false, 'message' => 'Error updating status.'];
            echo json_encode($response);
        }
    } catch (PDOException $e) {
        $response = ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        echo json_encode($response);
    }
} else {
    $response = ['success' => false, 'message' => 'Invalid input data.'];
    echo json_encode($response);
}

?>
