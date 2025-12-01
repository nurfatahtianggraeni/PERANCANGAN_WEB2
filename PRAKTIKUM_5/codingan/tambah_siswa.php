<?php
include 'koneksi.php';

// Proses simpan data siswa
if (isset($_POST['simpan'])) {
    $id_user = 1; // ID user default
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $status = 'Aktif'; // default status

    $query = "INSERT INTO siswa (id_user, nis, nama_siswa, kelas, alamat, no_telp, status)
              VALUES ('$id_user', '$nis', '$nama_siswa', '$kelas', '$alamat', '$no_telp', '$status')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data siswa berhasil disimpan!');window.location='data_siswa.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa | Go Smart Bimbel</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
        }
        .container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            padding: 25px;
            width: 600px;
            margin: 50px auto;
        }
        h2 {
            text-align: center;
            color: #3c91e6;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            font-weight: 600;
        }
        input, textarea {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 5px;
        }
        button {
            background-color: #3c91e6;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px;
            margin-top: 20px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #347dc7;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #3c91e6;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Form Tambah Data Siswa</h2>
        <form method="POST">
            <label>NIS</label>
            <input type="text" name="nis" placeholder="Masukkan NIS siswa" required>

            <label>Nama Lengkap</label>
            <input type="text" name="nama_siswa" placeholder="Masukkan nama siswa" required>

            <label>Kelas</label>
            <input type="text" name="kelas" placeholder="Contoh: 10A / 11 IPA 2" required>

            <label>Alamat</label>
            <textarea name="alamat" rows="3" placeholder="Masukkan alamat siswa" required></textarea>

            <label>No. HP</label>
            <input type="text" name="no_telp" placeholder="Masukkan nomor HP siswa" required>

            <button type="submit" name="simpan">Simpan Data</button>
        </form>

        <a href="data_siswa.php">⬅ Kembali ke Data Siswa</a>
    </div>

</body>
</html>
