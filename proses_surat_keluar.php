<?php
include 'lib/koneksi.php';
include 'lib/functions.php';
session_start();
if(isset($_POST['simpan_keluar'])){
    $nomor = $conn->real_escape_string($_POST['nomor_surat']);
    $tanggal = $_POST['tanggal_surat'];
    $tujuan = $conn->real_escape_string($_POST['tujuan']);
    $perihal = $conn->real_escape_string($_POST['perihal']);
    $status = $conn->real_escape_string($_POST['status_persetujuan']);

    $file = null;
    if(isset($_FILES['file_surat']) && $_FILES['file_surat']['size']>0){
        $ext = pathinfo($_FILES['file_surat']['name'], PATHINFO_EXTENSION);
        $file = 'SK_'.time().'.'.$ext;
        move_uploaded_file($_FILES['file_surat']['tmp_name'], 'upload/'.$file);
    }

    $sql = "INSERT INTO surat_keluar (nomor_surat,tanggal_surat,tujuan,perihal,file_surat,status_persetujuan)
            VALUES ('$nomor','$tanggal','$tujuan','$perihal','$file','$status')";
    $conn->query($sql);
    log_activity($_SESSION['user_id'] ?? 0, 'Menambah surat keluar: '.$nomor, $conn);
    header('Location: admin/surat_keluar.php');
}
