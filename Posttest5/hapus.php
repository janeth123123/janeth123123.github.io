<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "komunitas_hewan_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET["id"];

$sql = "DELETE FROM anggota WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil dihapus!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
