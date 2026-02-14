-- Database: absensi_guru
CREATE DATABASE IF NOT EXISTS absensi_guru;
USE absensi_guru;

-- Table Setting
CREATE TABLE IF NOT EXISTS setting (
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
);

-- Default Setting
INSERT INTO setting (nama_sekolah, kecamatan, kabupaten, nama_kepala, nip_kepala, tahun_ajaran, tempat) 
VALUES ('SD Negeri Sumberejo', 'Besuki', 'Situbondo', 'JATI SUSIYANTO, S.Pd. Gr', '19900126 201708 1 001', '2024 / 2025', 'Besuki');

-- Table Guru
CREATE TABLE IF NOT EXISTS guru (
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
);

-- Table Absensi
CREATE TABLE IF NOT EXISTS absensi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    guru_id INT,
    tanggal DATE,
    jam TIME,
    status VARCHAR(50),
    foto VARCHAR(255)
);

-- Table Hari Libur
CREATE TABLE IF NOT EXISTS hari_libur (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tanggal DATE,
    keterangan VARCHAR(255)
);

-- Table Slider Foto
CREATE TABLE IF NOT EXISTS slider_foto (
    id INT PRIMARY KEY AUTO_INCREMENT,
    file_path VARCHAR(255)
);

-- Table Kerja 5 Hari
CREATE TABLE IF NOT EXISTS kerja_5_hari (
    id INT PRIMARY KEY,
    is_5_hari TINYINT(1) DEFAULT 1
);
INSERT INTO kerja_5_hari (id, is_5_hari) VALUES (1, 1);
