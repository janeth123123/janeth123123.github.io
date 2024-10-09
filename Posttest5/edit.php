<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "komunitas_hewan_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nama = $_POST["name"];
    $umur = $_POST["age"];

    $sql = "UPDATE anggota SET nama='$nama', umur=$umur WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diperbarui!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $id = $_GET["id"];
    $sql = "SELECT * FROM anggota WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <form method="POST" action="edit.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="name">Nama:</label>
            <input type="text" name="name" value="<?php echo $row['nama']; ?>" required>
            <label for="age">Umur:</label>
            <input type="number" name="age" value="<?php echo $row['umur']; ?>" required>
            <input type="submit" value="Perbarui">
        </form>
        <?php
    } else {
        echo "Data tidak ditemukan.";
    }
}

$conn->close();
?>
