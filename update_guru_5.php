<?php
require_once 'config.php';

$sql = "CREATE TABLE IF NOT EXISTS lampiran_bulanan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bulan INT,
    tahun INT,
    data LONGTEXT,
    UNIQUE KEY(bulan, tahun)
)";

if (mysqli_query($conn, $sql)) {
    echo "Tabel 'lampiran_bulanan' berhasil dibuat!<br>";
    echo "<a href='index.php'>Kembali ke Dashboard</a>";
} else {
    echo "Gagal membuat tabel: " . mysqli_error($conn);
}
?>