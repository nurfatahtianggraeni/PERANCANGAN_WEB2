<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password' AND status='Aktif'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['role'] = $data['role'];

    header("Location: dashboard.php");
    exit;
} else {
    echo "<script>alert('Username atau Password salah / Akun nonaktif'); window.location='login.php';</script>";
}
?>
