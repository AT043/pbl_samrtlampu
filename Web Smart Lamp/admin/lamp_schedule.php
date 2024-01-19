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

// Cek apakah form telah disubmit
if (isset($_POST['submit'])) {
    // Ambil data dari form
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];

    // Validasi data (Tambahkan validasi sesuai kebutuhan)

    try {
        // Insert data ke tabel scheduling
        $query = "UPDATE scheduling SET mulai = :startTime, selesai = :endTime, tanggal = NOW() WHERE id = 1 AND username = :username";
    $stmt = $con->prepare($query);
        $stmt = $con->prepare($query);

        // Bind parameters
        $stmt->bindParam(':username', $currentUser['username']);
        $stmt->bindParam(':startTime', $startTime);
        $stmt->bindParam(':endTime', $endTime);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Jadwal berhasil disimpan!";
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $stmt->closeCursor();
}
?>
