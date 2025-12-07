<?php
include 'lib/koneksi.php';
session_start();
if(isset($_POST['arsipkan'])){
    $jenis = $_POST['jenis'];
    $id_ref = (int)$_POST['id_ref'];
    $keterangan = $conn->real_escape_string($_POST['keterangan']);
    if($jenis=='masuk'){
        $r = $conn->query("SELECT lampiran AS f FROM surat_masuk WHERE id_surat_masuk=$id_ref");
        $row = $r->fetch_assoc();
        $file = $row['f'] ?? null;
        $conn->query("INSERT INTO arsip (jenis,id_ref,file_arsip,keterangan) VALUES ('masuk',$id_ref,'$file','$keterangan')");
        $conn->query("UPDATE surat_masuk SET status='Diarsipkan' WHERE id_surat_masuk=$id_ref");
    } else {
        $r = $conn->query("SELECT file_surat AS f FROM surat_keluar WHERE id_surat_keluar=$id_ref");
        $row = $r->fetch_assoc();
        $file = $row['f'] ?? null;
        $conn->query("INSERT INTO arsip (jenis,id_ref,file_arsip,keterangan) VALUES ('keluar',$id_ref,'$file','$keterangan')");
        $conn->query("UPDATE surat_keluar SET status_persetujuan='Diarsipkan' WHERE id_surat_keluar=$id_ref");
    }
    header('Location: admin/arsip.php');
}
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
