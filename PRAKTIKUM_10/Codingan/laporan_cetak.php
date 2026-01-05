<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'koneksi.php';

use Mpdf\Mpdf;

$laporan = $_GET['laporan'] ?? 'siswa';

// konfigurasi mPDF (UTF-8 & Unicode)
$mpdf = new Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4',
    'margin_top' => 15,
    'margin_bottom' => 15,
    'margin_left' => 15,
    'margin_right' => 15
]);

ob_start(); // tangkap output HTML
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan PDF</title>

<style>
body{font-family:Arial;font-size:12px}
h3{text-align:center;margin-bottom:15px}
table{
    width:100%;
    border-collapse:collapse;
}
th{
    background:#444;
    color:white;
    padding:8px;
    border:1px solid #000;
}
td{
    padding:8px;
    border:1px solid #000;
}
</style>
</head>

<body>

<h3>
<?php
if($laporan=='siswa') echo "Laporan Data Siswa";
elseif($laporan=='jadwal') echo "Laporan Jadwal";
elseif($laporan=='materi') echo "Laporan Materi";
else echo "Laporan Pembayaran";
?>
</h3>

<!-- ================= LAPORAN SISWA ================= -->
<?php if($laporan=='siswa'){ ?>
<table>
<tr>
    <th>No</th>
    <th>Nama Siswa</th>
    <th>Kelas</th>
</tr>
<?php
$no=1;
$q=mysqli_query($koneksi,"SELECT nama_siswa, kelas FROM siswa");
while($r=mysqli_fetch_assoc($q)){
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $r['nama_siswa'] ?></td>
    <td><?= $r['kelas'] ?></td>
</tr>
<?php } ?>
</table>
<?php } ?>

<!-- ================= LAPORAN JADWAL ================= -->
<?php if($laporan=='jadwal'){ ?>
<table>
<tr>
    <th>No</th>
    <th>Kelas</th>
    <th>Hari</th>
    <th>Jam</th>
</tr>
<?php
$no=1;
$q=mysqli_query($koneksi,"
SELECT jadwal.hari, jadwal.jam_mulai, jadwal.jam_selesai, kelas.nama_kelas
FROM jadwal
JOIN kelas ON jadwal.id_kelas = kelas.id_kelas
");
while($r=mysqli_fetch_assoc($q)){
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $r['nama_kelas'] ?></td>
    <td><?= $r['hari'] ?></td>
    <td><?= $r['jam_mulai'].' - '.$r['jam_selesai'] ?></td>
</tr>
<?php } ?>
</table>
<?php } ?>

<!-- ================= LAPORAN MATERI ================= -->
<?php if($laporan=='materi'){ ?>
<table>
<tr>
    <th>No</th>
    <th>Kelas</th>
    <th>Judul Materi</th>
    <th>Tanggal</th>
</tr>
<?php
$no=1;
$q=mysqli_query($koneksi,"
SELECT materi.judul_materi, materi.tanggal_upload, kelas.nama_kelas
FROM materi
JOIN kelas ON materi.id_kelas=kelas.id_kelas
");
while($r=mysqli_fetch_assoc($q)){
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $r['nama_kelas'] ?></td>
    <td><?= $r['judul_materi'] ?></td>
    <td><?= date('d-m-Y',strtotime($r['tanggal_upload'])) ?></td>
</tr>
<?php } ?>
</table>
<?php } ?>

<!-- ================= LAPORAN PEMBAYARAN ================= -->
<?php if($laporan=='pembayaran'){ ?>
<table>
<tr>
    <th>No</th>
    <th>Nama Siswa</th>
    <th>Tanggal</th>
    <th>Jumlah</th>
    <th>Status</th>
</tr>
<?php
$no=1;
$q=mysqli_query($koneksi,"
SELECT transaksi.*, siswa.nama_siswa
FROM transaksi
JOIN siswa ON transaksi.id_siswa=siswa.id_siswa
");
while($r=mysqli_fetch_assoc($q)){
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $r['nama_siswa'] ?></td>
    <td><?= date('d-m-Y',strtotime($r['tgl'])) ?></td>
    <td>Rp <?= number_format($r['jml'],0,',','.') ?></td>
    <td><?= ucfirst($r['status']) ?></td>
</tr>
<?php } ?>
</table>
<?php } ?>

</body>
</html>

<?php
$html = ob_get_clean();

$mpdf->WriteHTML($html);
$mpdf->Output("Laporan-$laporan.pdf","I"); // I = tampil, D = download
