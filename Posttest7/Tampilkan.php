<?php
$data_file = __DIR__ . '/data.txt';
$data = [];

if (!file_exists($data_file)) {
    $error_message = "File data.txt tidak ditemukan.";
} else if (!is_readable($data_file)) {
    $error_message = "File data.txt tidak dapat dibaca.";
} else {
    $data = file($data_file, FILE_IGNORE_NEW_LINES);
    if (empty($data)) {
        $message = "File data.txt ada tetapi kosong.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e0e0e0;
        }
        .error {
            color: #e74c3c;
            font-weight: bold;
            background-color: #fadbd8;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .message {
            color: #2980b9;
            background-color: #d4e6f1;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .debug {
            background-color: #ecf0f1;
            padding: 15px;
            margin-top: 30px;
            border-radius: 4px;
            font-size: 0.9em;
        }
        a {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #2980b9;
        }
        pre {
            background-color: #fff;
            padding: 10px;
            border-radius: 4px;
            overflow-x: auto;
        }
        @media (max-width: 600px) {
            table {
                font-size: 0.8em;
            }
            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <h1>Data Anggota</h1>
    <?php if (isset($error_message)): ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php elseif (isset($message)): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    
    <?php if (!empty($data)): ?>
        <table>
            <tr>
                <th>Nama</th>
                <th>Umur</th>
                <th>File</th>
            </tr>
            <?php foreach ($data as $row): ?>
                <?php $fields = explode("|", $row); ?>
                <?php if (count($fields) >= 3): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fields[0]); ?></td>
                        <td><?php echo htmlspecialchars($fields[1]); ?></td>
                        <td>
                            <?php if (isset($fields[3]) && file_exists("uploads/" . $fields[3])): ?>
                                <a href="uploads/<?php echo htmlspecialchars($fields[3]); ?>" target="_blank">Lihat File</a>
                            <?php else: ?>
                                File tidak ditemukan
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Belum ada data anggota yang tersimpan.</p>
    <?php endif; ?>
    
    <a href="index.html#crud">Tambah Anggota Baru</a>
    <br>
    <a href="index.html">Kembali ke Beranda</a>

    <div class="debug">
        <h3>Debug Information:</h3>
        <p>File path: <?php echo $data_file; ?></p>
        <p>File exists: <?php echo file_exists($data_file) ? 'Yes' : 'No'; ?></p>
        <p>File readable: <?php echo is_readable($data_file) ? 'Yes' : 'No'; ?></p>
        <p>File size: <?php echo file_exists($data_file) ? filesize($data_file) . ' bytes' : 'N/A'; ?></p>
        <p>File contents:</p>
        <pre><?php echo file_exists($data_file) ? htmlspecialchars(file_get_contents($data_file)) : 'N/A'; ?></pre>
    </div>
</body>
</html>