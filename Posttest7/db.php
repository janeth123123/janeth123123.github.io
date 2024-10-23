<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "komunitas_pencinta_hewan_db";

// Mengaktifkan error reporting untuk mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Set charset untuk mendukung karakter UTF-8
    $conn->set_charset("utf8");

} catch (mysqli_sql_exception $e) {
    // Menangani error koneksi
    die("Koneksi gagal: " . $e->getMessage());
}
?>
