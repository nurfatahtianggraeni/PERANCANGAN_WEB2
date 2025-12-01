<?php
include 'koneksi.php';

// Hapus data siswa
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM siswa WHERE id_siswa='$id'");
    echo "<script>alert('Data siswa berhasil dihapus!');window.location='data_siswa.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa | Go Smart Bimbel</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f8;
            margin: 0;
        }
        .header {
            background: #3c91e6;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #3c91e6;
            color: white;
        }
        tr:hover {
            background: #f1f1f1;
        }
        .btn {
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
        }
        .tambah {
            background: #3c91e6;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            display: inline-block;
            margin-bottom: 15px;
        }
        .edit { background: #f0ad4e; }
        .hapus { background: #d9534f; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Admin - Go Smart Bimbel</h1>
        <a href="logout.php" style="color:white;text-decoration:none;">Logout</a>
    </div>

    <div class="sidebar">
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="data_siswa.php">👩‍🎓 Data Siswa</a>
        <a href="data_kelas.php">🏫 Data Kelas</a>
        <a href="data_materi.php">📘 Materi</a>
        <a href="laporan.php">📊 Laporan</a>
        <a href="transaksi.php">💰 Transaksi</a>
        <a href="history.php">🕓 History</a>
    </div>

    <div class="main">
        <h2>Data Siswa</h2>
        <a href="tambah_siswa.php" class="tambah">+ Tambah Data</a>
        <table>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Alamat</th>
                <th>No. HP</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $result = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY id_siswa DESC");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                <tr>
                    <td>$no</td>
                    <td>{$row['nis']}</td>
                    <td>{$row['nama_siswa']}</td>
                    <td>{$row['kelas']}</td>
                    <td>{$row['alamat']}</td>
                    <td>{$row['no_telp']}</td>
                    <td>{$row['status']}</td>
                    <td>
                        <a href='edit_siswa.php?id={$row['id_siswa']}' class='btn edit'>Edit</a>
                        <a href='data_siswa.php?hapus={$row['id_siswa']}' class='btn hapus' onclick='return confirm(\"Yakin ingin hapus data ini?\")'>Hapus</a>
                    </td>
                </tr>";
                $no++;
            }
            ?>
        </table>
    </div>

</body>
</html>
