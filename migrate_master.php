<?php
require_once 'config.php';

$sql = "CREATE TABLE IF NOT EXISTS master_sarana_lain (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kategori ENUM('sarana', 'lain'),
    nama VARCHAR(255),
    satuan VARCHAR(100)
)";

if (mysqli_query($conn, $sql)) {
    echo "Tabel 'master_sarana_lain' berhasil dibuat.<br>";
} else {
    die("Error creating table: " . mysqli_error($conn));
}

// Seed initial data
$items = [
    ['sarana', 'Bangku 1 Peserta', 'buah'],
    ['sarana', 'Bangku 2 Peserta', 'buah'],
    ['sarana', 'Lemari kayu', 'buah'],
    ['sarana', 'Rak buku', 'buah'],
    ['sarana', 'Papan tulis', 'buah'],
    ['sarana', 'Rak Perpustakaan', 'buah'],
    ['sarana', 'Rak Besi', 'buah'],
    ['sarana', 'Mesin Tik', 'buah'],
    ['sarana', 'Mesin Jahit', 'buah'],
    ['sarana', 'KIT IPA', 'buah'],
    ['sarana', 'Kerangka Manusia', 'buah'],
    ['sarana', 'KIT IPS', 'buah'],
    ['sarana', 'Torso Lembu', 'buah'],
    ['sarana', 'Kursi Guru', 'buah'],
    ['sarana', 'Meja Guru', 'buah'],
    ['sarana', 'Tape Recorder', 'buah'],
    ['sarana', 'Atlas', 'buah'],
    ['sarana', 'Globe', 'buah'],
    ['sarana', 'Alur Pencernaan', 'buah'],
    ['sarana', 'Bola Sepak', 'buah'],
    ['sarana', 'Bola Takraw', 'buah'],
    ['sarana', 'Raket', 'buah'],
    ['sarana', 'Kulintang', 'buah'],
    ['sarana', 'Gamelan', 'buah'],
    ['sarana', 'Sambroh', 'buah'],
    ['lain', 'Kursi tamu', 'set'],
    ['lain', 'Kursi Ka. SD', 'buah']
];

foreach ($items as $item) {
    $kategori = $item[0];
    $nama = $item[1];
    $satuan = $item[2];

    $check = mysqli_query($conn, "SELECT id FROM master_sarana_lain WHERE nama='$nama'");
    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "INSERT INTO master_sarana_lain (kategori, nama, satuan) VALUES ('$kategori', '$nama', '$satuan')");
    }
}

echo "Data awal berhasil dimasukkan!<br>";
unlink(__FILE__); // Self-delete
?>