<?php
$host = "localhost";      // nama host server
$user = "root";           // username MySQL kamu (default: root)
$pass = "";               // password MySQL kamu (kosongkan kalau tidak ada)
$db   = "bimbel";         // GANTI dengan nama database kamu

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
