<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $upload_dir = __DIR__ . '/uploads/';
    
    // Cek apakah direktori uploads ada, jika tidak, coba buat
    if (!file_exists($upload_dir)) {
        if (!mkdir($upload_dir, 0755, true)) {
            die("Gagal membuat direktori uploads. Mohon periksa izin direktori.");
        }
    }

    if (isset($_FILES["fileUpload"]) && $_FILES["fileUpload"]["error"] == 0) {
        $file_name = date("Y-m-d H.i.s") . "." . pathinfo($_FILES["fileUpload"]["name"], PATHINFO_EXTENSION);
        $target_file = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
            $data = "$name|$age|$password|$file_name\n";
            $result = file_put_contents("data.txt", $data, FILE_APPEND);
            if ($result === false) {
                die("Error: Tidak dapat menulis ke file data.txt. Periksa izin file.");
            } else {
                echo "Data berhasil disimpan! ";
                echo "Bytes written: $result. ";
                echo "File uploaded: $file_name<br>";
                echo "<a href='tampilkan.php'>Lihat Data Anggota</a>";
                exit();
            }
        } else {
            $upload_error = error_get_last();
            die("Maaf, terjadi kesalahan saat mengunggah file. Error: " . $upload_error['message']);
        }
    } else {
        die("Error uploading file: " . $_FILES["fileUpload"]["error"]);
    }
}
?>