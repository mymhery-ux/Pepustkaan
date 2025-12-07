<?php
include 'lib/koneksi.php';
include 'lib/functions.php';
session_start();
if(isset($_POST['simpan'])){
    $nomor = $conn->real_escape_string($_POST['nomor_surat']);
    $tanggal = $_POST['tanggal_surat'];
    $pengirim = $conn->real_escape_string($_POST['pengirim']);
    $perihal = $conn->real_escape_string($_POST['perihal']);

    $lampiran = null;
    if(isset($_FILES['lampiran']) && $_FILES['lampiran']['size']>0){
        $ext = pathinfo($_FILES['lampiran']['name'], PATHINFO_EXTENSION);
        $lampiran = 'LM_'.time().'.'.$ext;
        move_uploaded_file($_FILES['lampiran']['tmp_name'], 'upload/'.$lampiran);
    }

    $sql = "INSERT INTO surat_masuk (nomor_surat,tanggal_surat,pengirim,perihal,lampiran) VALUES ('$nomor','$tanggal','$pengirim','$perihal','$lampiran')";
    $conn->query($sql);
    log_activity($_SESSION['user_id'] ?? 0, 'Menambah surat masuk: '.$nomor, $conn);
    header('Location: admin/surat_masuk.php');
}
