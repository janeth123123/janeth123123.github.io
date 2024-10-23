<?php
session_start();

// Cek apakah sesi user sudah diset
if (!isset($_SESSION['user'])) {
    // Jika tidak, arahkan ke halaman login
    header("Location: login.php");
    exit;
}

// Pilihan tambahan untuk meningkatkan keamanan (Opsional)
// Ini bisa menambah layer keamanan terhadap serangan clickjacking dan MIME sniffing
header("Content-Type: text/html; charset=UTF-8");
header("X-Frame-Options: SAMEORIGIN"); 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['user']); ?></h2> <!-- Menggunakan htmlspecialchars untuk keamanan -->
    <a href="logout.php">Logout</a>
</body>
</html>
