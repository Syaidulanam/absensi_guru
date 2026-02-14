<?php
require_once 'config.php';

$sql = "ALTER TABLE guru ADD COLUMN IF NOT EXISTS tgl_sk VARCHAR(50) AFTER tmt";

if (mysqli_query($conn, $sql)) {
    echo "Tabel 'guru' berhasil diperbarui (tahap 3 - Tanggal SK)!<br>";
    echo "<a href='index.php'>Kembali ke Dashboard</a>";
} else {
    echo "Gagal memperbarui tabel: " . mysqli_error($conn);
}
?>