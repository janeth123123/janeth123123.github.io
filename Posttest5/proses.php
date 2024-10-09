<?php
$servername = "localhost";  // Sesuaikan jika perlu
$username = "root";         // Sesuaikan jika perlu
$password = "";             // Sesuaikan jika perlu
$dbname = "komunitas_hewan";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menangani pengiriman form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["name"];
    $umur = $_POST["age"];
    $kata_sandi = password_hash($_POST["password"], PASSWORD_DEFAULT);  // Hashing kata sandi

    $sql = "INSERT INTO anggota (nama, umur, kata_sandi) VALUES ('$nama', $umur, '$kata_sandi')";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
