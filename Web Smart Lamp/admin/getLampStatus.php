<?php
// Assuming this file is getLampStatus.php
include('../ClassLamp.php'); // Make sure to include your lamp class

$lampNumber = 1; // You might want to get this from somewhere

// Get lamp status
$status = $lamp->getLampStatusFromStorage($lampNumber);

// Return the status as JSON
echo json_encode(['status' => $status]);
?>
