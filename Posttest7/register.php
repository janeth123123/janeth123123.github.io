<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Meng-hash password

    // Menyiapkan pernyataan SQL untuk memasukkan data baru
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $username, $email, $password);

    // Mengeksekusi query dan mengarahkan ke halaman login jika sukses
    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Registrasi gagal: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Registrasi</title>
</head>
<body>
    <h2>Form Registrasi</h2>
    <form method="POST" action="register.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        
        <input type="submit" value="Daftar">
    </form>
</body>
</html>
