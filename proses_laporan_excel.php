<?php
// Ekspor CSV sederhana agar tidak bergantung pada composer
include 'lib/koneksi.php';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=laporan_surat_keluar.csv');
$out = fopen('php://output', 'w');
fputcsv($out, ['No','Nomor Surat','Tanggal','Tujuan','Perihal','Status']);
$q = $conn->query('SELECT nomor_surat,tanggal_surat,tujuan,perihal,status_persetujuan FROM surat_keluar');
$i=1;
while($r=$q->fetch_assoc()){
    fputcsv($out, [$i++, $r['nomor_surat'], $r['tanggal_surat'], $r['tujuan'], $r['perihal'], $r['status_persetujuan']]);
}
fclose($out);
