<?php
// get_lamp_status.php
require_once "../dbconfig.php";

// Fetch the current status of lamps from the smart_lamp table
$stmt = $con->prepare("SELECT no_lampu, status FROM smart_lamp");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the results as JSON
header('Content-Type: application/json');
echo json_encode($results);
?>
