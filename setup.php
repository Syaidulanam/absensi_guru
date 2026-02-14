<?php
$host = "localhost";
$user = "root";
$pass = "";

$conn = mysqli_connect($host, $user, $pass);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Buat Database
$sql = "CREATE DATABASE IF NOT EXISTS absensi_guru";
if (mysqli_query($conn, $sql)) {
    echo "Database 'absensi_guru' berhasil dibuat atau sudah ada.<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

// Create folders if not exists
if (!file_exists('uploads')) {
    mkdir('uploads', 0777, true);
    echo "Folder 'uploads' berhasil dibuat.<br>";
}
if (!file_exists('absensi_data')) {
    mkdir('absensi_data', 0777, true);
    echo "Folder 'absensi_data' berhasil dibuat.<br>";
}

mysqli_select_db($conn, "absensi_guru");

// Table Setting
$sql = "CREATE TABLE IF NOT EXISTS setting (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_sekolah VARCHAR(255),
    npsn VARCHAR(50),
    alamat TEXT,
    kecamatan VARCHAR(100),
    kabupaten VARCHAR(100),
    nama_kepala VARCHAR(255),
    nip_kepala VARCHAR(50),
    foto_kepala VARCHAR(255),
    logo_sekolah VARCHAR(255),
    tahun_ajaran VARCHAR(50),
    tempat VARCHAR(100)
)";
mysqli_query($conn, $sql);

// Check if settings exist, if not insert default
$check = mysqli_query($conn, "SELECT id FROM setting LIMIT 1");
if (mysqli_num_rows($check) == 0) {
    mysqli_query($conn, "INSERT INTO setting (nama_sekolah, kecamatan, kabupaten, nama_kepala, nip_kepala, tahun_ajaran, tempat) 
    VALUES ('SD Negeri Sumberejo', 'Besuki', 'Situbondo', 'JATI SUSIYANTO, S.Pd. Gr', '19900126 201708 1 001', '2024 / 2025', 'Besuki')");
}

// Table Guru
$sql = "CREATE TABLE IF NOT EXISTS guru (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(255),
    tempat_lahir VARCHAR(100),
    tgl_lahir DATE,
    nip VARCHAR(50),
    nuptk VARCHAR(50),
    jk ENUM('L', 'P'),
    jabatan VARCHAR(100),
    status_jabatan VARCHAR(100),
    gol_ruang VARCHAR(50),
    tmt VARCHAR(50),
    tgl_sk VARCHAR(50),
    no_sk VARCHAR(100),
    mulai_angkat VARCHAR(50),
    mulai_tugas_disini VARCHAR(50),
    catatan TEXT,
    foto VARCHAR(255)
)";
mysqli_query($conn, $sql);

// Table Absensi
$sql = "CREATE TABLE IF NOT EXISTS absensi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    guru_id INT,
    tanggal DATE,
    jam TIME,
    status VARCHAR(50),
    foto VARCHAR(255)
)";
mysqli_query($conn, $sql);

// Table Hari Libur
$sql = "CREATE TABLE IF NOT EXISTS hari_libur (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tanggal DATE,
    keterangan VARCHAR(255)
)";
mysqli_query($conn, $sql);

// Table Slider Foto
$sql = "CREATE TABLE IF NOT EXISTS slider_foto (
    id INT PRIMARY KEY AUTO_INCREMENT,
    file_path VARCHAR(255)
)";
mysqli_query($conn, $sql);

// Table Kerja 5 Hari
$sql = "CREATE TABLE IF NOT EXISTS kerja_5_hari (
    id INT PRIMARY KEY,
    is_5_hari TINYINT(1) DEFAULT 1
)";
mysqli_query($conn, $sql);
mysqli_query($conn, "INSERT IGNORE INTO kerja_5_hari (id, is_5_hari) VALUES (1, 1)");

// Table Master Sarana & Lain
$sql = "CREATE TABLE IF NOT EXISTS master_sarana_lain (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kategori ENUM('sarana', 'lain'),
    nama VARCHAR(255),
    satuan VARCHAR(100)
)";
mysqli_query($conn, $sql);

// Seed Master Sarana & Lain if empty
$check_m = mysqli_query($conn, "SELECT id FROM master_sarana_lain LIMIT 1");
if (mysqli_num_rows($check_m) == 0) {
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
    foreach ($items as $it) {
        mysqli_query($conn, "INSERT INTO master_sarana_lain (kategori, nama, satuan) VALUES ('{$it[0]}', '{$it[1]}', '{$it[2]}')");
    }
}

echo "Semua tabel berhasil disiapkan!<br>";
echo "<a href='index.php'>Buka Dashboard</a>";
?>