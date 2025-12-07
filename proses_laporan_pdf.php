<?php
// sederhana: buat tabel HTML dan tampilkan (TCPDF direkomendasikan)
include 'lib/koneksi.php';
$start = $_GET['start'] ?? null;
$end = $_GET['end'] ?? null;
$where = '';
if($start && $end){
    $where = "WHERE tanggal_surat BETWEEN '$start' AND '$end'";
}
$sql = "SELECT nomor_surat,tanggal_surat,tujuan,perihal,status_persetujuan FROM surat_keluar $where";
$res = $conn->query($sql);

$html = '<h3>Laporan Surat Keluar</h3><table border="1" cellpadding="6"><tr><th>No</th><th>Nomor</th><th>Tanggal</th><th>Tujuan</th><th>Perihal</th><th>Status</th></tr>';
$i=1;
while($r=$res->fetch_assoc()){
    $html .= '<tr><td>'.$i++.'</td><td>'.$r['nomor_surat'].'</td><td>'.$r['tanggal_surat'].'</td><td>'.$r['tujuan'].'</td><td>'.$r['perihal'].'</td><td>'.$r['status_persetujuan'].'</td></tr>';
}
$html .= '</table>';
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="laporan_surat_keluar.html"');
echo $html;
