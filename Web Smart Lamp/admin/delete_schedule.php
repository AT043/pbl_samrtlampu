<?php
// Lampirkan dbconfig
require_once "../dbconfig.php";

// Cek status login user
if (!$person->isLoggedIn()) {
    header("location: ../login.php"); //Redirect ke halaman login
    exit();
}

// Ambil data user saat ini
$currentUser = $person->getUser();

// Function to delete scheduling data
function deleteScheduleData() {
    global $con, $currentUser;

    try {
        $query = "UPDATE scheduling SET mulai = NULL, selesai = NULL WHERE id = 1 AND username = :username";
        $stmt = $con->prepare($query);

        // Bind parameters
        $stmt->bindParam(':username', $currentUser['username']);

        // Execute the statement
        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Delete scheduling data
$result = deleteScheduleData();

// Return the result as JSON
echo json_encode(['success' => $result]);
?>
