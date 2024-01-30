<?php
require_once 'dbconfig.php';

// Run the Python script and capture its output
$output = shell_exec("C:\Users\Daffa Assyam Thariq\AppData\Local\Programs\Python\Python311\python.exe mysql.py");

// Check if the command was successful
if ($output !== null) {
    echo "Reset password berhasil!";
} else {
    echo "Error! gagal menjalankan script nih";
}

// Optionally, you can also display the output of the Python script
echo "<pre>$output</pre>";
?>
