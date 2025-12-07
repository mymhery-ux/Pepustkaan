<?php
include 'lib/koneksi.php';
include 'lib/functions.php';
session_start();
if(isset($_POST['disposisi'])){
    $id_surat = (int)$_POST['id_surat'];
    $instruksi = $conn->real_escape_string($_POST['instruksi']);
    $id_staff = (int)$_POST['id_staff'];
    $id_pimpinan = $_SESSION['user_id'] ?? 0;

    $sql = "INSERT INTO disposisi (id_surat_masuk,id_pimpinan,id_staff,instruksi) VALUES ($id_surat,$id_pimpinan,$id_staff,'$instruksi')";
    $conn->query($sql);
    $conn->query("UPDATE surat_masuk SET status='Dalam Disposisi' WHERE id_surat_masuk=$id_surat");
    log_activity($id_pimpinan, 'Mendisposisi surat ID '.$id_surat, $conn);
    header('Location: admin/disposisi.php');
}
