<?php
include 'koneksi.php';

$laporan = $_GET['laporan'] ?? 'siswa';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Kepala Bimbel</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:#FFF3DC}

/* HEADER */
.header{
    width:100%;
    height:70px;
    background:linear-gradient(135deg,#81C784,#64B5F6);
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 40px;
    color:white;
}

/* MAIN */
.main{
    max-width:1100px;
    margin:40px auto;
    padding:0 20px;
}

/* BOX */
.box{
    background:#FFF7FB;
    border-radius:25px;
    border:2px solid #FFB6C1;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
    padding:30px;
}

/* TAB */
.tabs{
    margin-bottom:25px;
}
.tabs a{
    display:inline-block;
    padding:10px 20px;
    background:#FFD1DC;
    color:#6D4C41;
    border-radius:20px;
    text-decoration:none;
    margin-right:8px;
    font-size:14px;
}
.tabs a.active{
    background:#81C784;
    color:white;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
}
th{
    background:#FFB6C1;
    color:white;
    padding:12px;
}
td{
    padding:12px;
    border-bottom:1px solid #F8BBD0;
    color:#6D4C41;
}
tr:hover{background:#FFE4EC}
</style>
</head>

<body>

<div class="header">
    <h3>Laporan Kepala Bimbel – Go Smart</h3>
    <a href="logout.php" style="color:white;text-decoration:none;">Logout</a>
</div>

<a href="laporan_cetak.php?laporan=<?= $laporan ?>" 
   target="_blank"
   style="padding:10px 15px;background:#4CAF50;color:white;border-radius:8px;text-decoration:none;">
   Cetak PDF
</a>

<div class="main">
<div class="box">

<div class="tabs">
    <a href="?laporan=siswa" class="<?= $laporan=='siswa'?'active':'' ?>">Data Siswa</a>
    <a href="?laporan=jadwal" class="<?= $laporan=='jadwal'?'active':'' ?>">Jadwal</a>
    <a href="?laporan=materi" class="<?= $laporan=='materi'?'active':'' ?>">Materi</a>
    <a href="?laporan=pembayaran" class="<?= $laporan=='pembayaran'?'active':'' ?>">Pembayaran</a>
</div>

<!-- ================= LAPORAN SISWA ================= -->
<?php if($laporan=='siswa'){ ?>
<h3>Laporan Data Siswa</h3><br>
<table>
<tr>
    <th>No</th>
    <th>Nama Siswa</th>
    <th>Kelas</th>
</tr>
<?php
$no=1;
$q=mysqli_query($koneksi,"
    SELECT siswa.nama_siswa, siswa.kelas
    FROM siswa
");
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
<h3>Laporan Jadwal</h3><br>
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
    SELECT 
    jadwal.hari,
    jadwal.jam_mulai,
    jadwal.jam_selesai,
    kelas.nama_kelas
FROM jadwal
JOIN kelas ON jadwal.id_kelas = kelas.id_kelas
");
while($r=mysqli_fetch_assoc($q)){
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $r['nama_kelas'] ?></td>
    <td><?= $r['hari'] ?></td>
    <td><?= $r['jam_mulai'] ?> - <?= $r['jam_selesai'] ?></td>
</tr>
<?php } ?>
</table>
<?php } ?>

<!-- ================= LAPORAN MATERI ================= -->
<?php if($laporan=='materi'){ ?>
<h3>Laporan Materi</h3><br>
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
<h3>Laporan Pembayaran</h3><br>
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

</div>
</div>

</body>
</html>
