<?php
require_once 'config.php';

$sql = "ALTER TABLE guru ADD COLUMN IF NOT EXISTS catatan TEXT AFTER mulai_tugas_disini";

if (mysqli_query($conn, $sql)) {
    echo "Tabel 'guru' berhasil diperbarui (tahap 4 - Catatan)!<br>";
    echo "<a href='index.php'>Kembali ke Dashboard</a>";
} else {
    echo "Gagal memperbarui tabel: " . mysqli_error($conn);
}
?>