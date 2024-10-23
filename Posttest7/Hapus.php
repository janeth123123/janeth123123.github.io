<?php
$data = file("data.txt", FILE_IGNORE_NEW_LINES);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $index = $_POST["index"];
    $file_to_delete = explode("|", $data[$index])[3];
    unlink("uploads/" . $file_to_delete);
    unset($data[$index]);
    file_put_contents("data.txt", implode("\n", $data));
    header("Location: tampilkan.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data Anggota</title>
</head>
<body>
    <h1>Hapus Data Anggota</h1>
    <ul>
    <?php foreach ($data as $index => $row): ?>
    <?php $fields = explode("|", $row); ?>
    <li>
        <?php echo htmlspecialchars($fields[0]); ?> (<?php echo htmlspecialchars($fields[1]); ?> tahun)
        <form method="POST" style="display: inline;">
            <input type="hidden" name="index" value="<?php echo $index; ?>">
            <input type="submit" value="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
        </form>
    </li>
    <?php endforeach; ?>
    </ul>
    <br>
    <a href="tampilkan.php">Kembali ke Daftar Anggota</a>
</body>
</html>