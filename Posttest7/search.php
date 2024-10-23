<?php
include 'db.php';

if (isset($_GET['query'])) {
    $search = $_GET['query'];

    // Ganti 'name' dengan nama kolom yang sesuai, misalnya 'nama'
    $stmt = $conn->prepare("SELECT * FROM anggota WHERE nama_anggota LIKE ?");
    $search = "%$search%";
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Pencarian</title>
</head>
<body>
    <h2>Hasil Pencarian</h2>
    <form method="GET" action="search.php">
        <input type="text" name="query" placeholder="Cari anggota...">
        <input type="submit" value="Cari">
    </form>

    <?php if (isset($result)): ?>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <!-- Pastikan 'nama' adalah nama kolom yang benar -->
                <li><?php echo $row['nama']; ?></li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
