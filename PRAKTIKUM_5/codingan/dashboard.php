<?php
include 'koneksi.php';
session_start();

// (opsional) kalau kamu mau batasi akses hanya untuk user login:
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$total_siswa_query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM siswa");
$total_siswa = mysqli_fetch_assoc($total_siswa_query)['total'] ?? 0;

$total_kelas_query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM kelas");
$total_kelas = mysqli_fetch_assoc($total_kelas_query)['total'] ?? 0;

$total_materi_query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM materi");
$total_materi = mysqli_fetch_assoc($total_materi_query)['total'] ?? 0;

$total_transaksi_query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM transaksi");
$total_transaksi = mysqli_fetch_assoc($total_transaksi_query)['total'] ?? 0;

$username = $_SESSION['username'] ?? 'Admin';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Go Smart Bimbel</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
        }
        .header {
            background: #3c91e6;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 220px; /* supaya gak ketiban sidebar */
            right: 0;
            height: 60px;
            z-index: 10;
        }
        .sidebar {
            width: 220px;
            height: 100vh;
            background: #2f3640;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 70px;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #3c91e6;
        }
        .main {
            margin-left: 240px;
            padding: 100px 20px 20px; /* kasih jarak dari header */
        }
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            width: 220px;
            display: inline-block;
            text-align: center;
        }
        .card h2 {
            color: #3c91e6;
            font-size: 24px;
        }
        .logout-btn {
            background: #e74c3c;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="data_siswa.php">👩‍🎓 Data Siswa</a>
        <a href="data_kelas.php">🏫 Data Kelas</a>
        <a href="data_materi.php">📘 Materi</a>
        <a href="laporan.php">📊 Laporan</a>
        <a href="transaksi.php">💰 Transaksi</a>
    </div>

    <div class="header">
        <h1>Dashboard Admin - Go Smart Bimbel</h1>
        <a href="#" class="logout-btn">Logout</a>
    </div>

    <div class="main">
        <h2>Selamat datang, <?php echo htmlspecialchars($username); ?> </h2>
        <p>Berikut ringkasan data sistem:</p>

        <div class="card">
            <h2><?php echo $total_siswa; ?></h2>
            <p>Total Siswa</p>
        </div>

        <div class="card">
            <h2><?php echo $total_kelas; ?></h2>
            <p>Total Kelas</p>
        </div>

        <div class="card">
            <h2><?php echo $total_materi; ?></h2>
            <p>Total Materi</p>
        </div>

        <div class="card">
            <h2><?php echo $total_transaksi; ?></h2>
            <p>Total Transaksi</p>
        </div>
    </div>

</body>
</html>
