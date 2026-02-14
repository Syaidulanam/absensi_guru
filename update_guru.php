<?php
require_once 'config.php';

$sql = "ALTER TABLE guru 
        ADD COLUMN IF NOT EXISTS tempat_lahir VARCHAR(100) AFTER nama,
        ADD COLUMN IF NOT EXISTS tgl_lahir DATE AFTER tempat_lahir,
        ADD COLUMN IF NOT EXISTS nuptk VARCHAR(50) AFTER nip,
        ADD COLUMN IF NOT EXISTS jk ENUM('L', 'P') AFTER nuptk,
        ADD COLUMN IF NOT EXISTS status_jabatan VARCHAR(100) AFTER jabatan";

if (mysqli_query($conn, $sql)) {
    echo "Tabel 'guru' berhasil diperbarui!<br>";
    echo "<a href='index.php'>Kembali ke Dashboard</a>";
} else {
    echo "Gagal memperbarui tabel: " . mysqli_error($conn);
}
?>