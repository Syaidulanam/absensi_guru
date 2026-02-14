<?php
require_once 'config.php';

$sql = "ALTER TABLE guru 
        ADD COLUMN IF NOT EXISTS gol_ruang VARCHAR(50) AFTER status_jabatan,
        ADD COLUMN IF NOT EXISTS tmt VARCHAR(50) AFTER gol_ruang,
        ADD COLUMN IF NOT EXISTS no_sk VARCHAR(100) AFTER tmt,
        ADD COLUMN IF NOT EXISTS mulai_angkat VARCHAR(50) AFTER no_sk,
        ADD COLUMN IF NOT EXISTS mulai_tugas_disini VARCHAR(50) AFTER mulai_angkat";

if (mysqli_query($conn, $sql)) {
    echo "Tabel 'guru' berhasil diperbarui (tahap 2)!<br>";
    echo "<a href='index.php'>Kembali ke Dashboard</a>";
} else {
    echo "Gagal memperbarui tabel: " . mysqli_error($conn);
}
?>