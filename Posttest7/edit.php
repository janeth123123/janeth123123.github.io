<?php
$data = file("data.txt", FILE_IGNORE_NEW_LINES);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $index = $_POST["index"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $old_file = explode("|", $data[$index])[3];

    if (isset($_FILES["fileUpload"]) && $_FILES["fileUpload"]["error"] == 0) {
        $file_name = date("Y-m-d H.i.s") . "." . pathinfo($_FILES["fileUpload"]["name"], PATHINFO_EXTENSION);
        $target_dir = "uploads/";
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
            // Delete old file
            unlink("uploads/" . $old_file);
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
            exit();
        }
    } else {
        $file_name = $old_file;
    }

    $data[$index] = "$name|$age|$password|$file_name";
    file_put_contents("data.txt", implode("\n", $data));
    header("Location: tampilkan.php");
    exit();
}

$index = isset($_GET["index"]) ? $_GET["index"] : null;
$selected_data = ($index !== null && isset($data[$index])) ? explode("|", $data[$index]) : null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Anggota</title>
</head>
<body>
    <h1>Edit Data Anggota</h1>
    <?php if ($selected_data): ?>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="index" value="<?php echo $index; ?>">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($selected_data[0]); ?>" required><br>
        <label for="age">Umur:</label>
        <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($selected_data[1]); ?>" required><br>
        <label for="password">Kata Sandi Baru:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="fileUpload">Upload File Baru (opsional):</label>
        <input type="file" id="fileUpload" name="fileUpload"><br>
        <input type="submit" value="Simpan Perubahan">
    </form>
    <?php else: ?>
    <p>Pilih data yang ingin diedit:</p>
    <ul>
    <?php foreach ($data as $index => $row): ?>
    <?php $fields = explode("|", $row); ?>
    <li><a href="?index=<?php echo $index; ?>"><?php echo htmlspecialchars($fields[0]); ?></a></li>
    <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <br>
    <a href="tampilkan.php">Kembali ke Daftar Anggota</a>
</body>
</html>