
<?php
                // Menampilkan hasil input dari PHP jika ada
                if (isset($_GET['name']) && isset($_GET['age'])) {
                    echo "<h3>Data Pendaftar:</h3>";
                    echo "<p>Nama: " . htmlspecialchars($_GET['name']) . "</p>";
                    echo "<p>Umur: " . htmlspecialchars($_GET['age']) . "</p>";
                }
                ?>
<?php
// Mengambil data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);
    $password = htmlspecialchars($_POST['password']);

    // Redirect kembali ke index.html dengan data yang diterima
    header("Location: index.html?name=$name&age=$age");
    exit();
}
?>
