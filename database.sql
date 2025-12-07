-- Database schema sederhana untuk SIS-SURAT
CREATE DATABASE IF NOT EXISTS sis_surat CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE sis_surat;

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    role ENUM('superadmin','admin','pimpinan','staff','publik') DEFAULT 'staff',
    jabatan VARCHAR(100),
    bagian VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE surat_masuk (
    id_surat_masuk INT AUTO_INCREMENT PRIMARY KEY,
    nomor_surat VARCHAR(100),
    tanggal_surat DATE,
    pengirim VARCHAR(150),
    perihal TEXT,
    lampiran VARCHAR(255),
    status VARCHAR(50) DEFAULT 'Menunggu Disposisi'
);

CREATE TABLE surat_keluar (
    id_surat_keluar INT AUTO_INCREMENT PRIMARY KEY,
    nomor_surat VARCHAR(100),
    tanggal_surat DATE,
    tujuan VARCHAR(150),
    perihal TEXT,
    file_surat VARCHAR(255),
    status_persetujuan VARCHAR(50) DEFAULT 'Draft'
);

CREATE TABLE disposisi (
    id_disposisi INT AUTO_INCREMENT PRIMARY KEY,
    id_surat_masuk INT,
    id_pimpinan INT,
    id_staff INT,
    instruksi TEXT,
    tanggal_disposisi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status_tindak_lanjut VARCHAR(50) DEFAULT 'Belum Ditindaklanjuti',
    FOREIGN KEY (id_surat_masuk) REFERENCES surat_masuk(id_surat_masuk) ON DELETE CASCADE,
    FOREIGN KEY (id_pimpinan) REFERENCES users(id_user) ON DELETE SET NULL,
    FOREIGN KEY (id_staff) REFERENCES users(id_user) ON DELETE SET NULL
);

CREATE TABLE arsip (
    id_arsip INT AUTO_INCREMENT PRIMARY KEY,
    jenis ENUM('masuk','keluar'),
    id_ref INT,
    file_arsip VARCHAR(255),
    tanggal_arsip TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    keterangan TEXT
);

CREATE TABLE log_aktifitas (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    aktifitas TEXT,
    waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==============================
-- DEFAULT SUPERADMIN ACCOUNT
-- Username: admin
-- Password: admin123
-- ==============================

INSERT INTO users (id, username, password, role)
VALUES (
    1,
    'admin',
    '$2y$10$1O5e.T/F31ZU1hC/VuV2EeMGf5XIqHWsA3WSVnnZ9N4RjRrvsye12',
    'superadmin'
)
ON DUPLICATE KEY UPDATE
    username = VALUES(username),
    password = VALUES(password),
    role = VALUES(role);
