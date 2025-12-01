<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$id'"));

if (isset($_POST['update'])) {
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $status = $_POST['status'];

    $update = "UPDATE siswa SET 
        nis='$nis', nama_siswa='$nama_siswa', kelas='$kelas', 
        alamat='$alamat', no_telp='$no_telp', status='$status' 
        WHERE id_siswa='$id'";
    if (mysqli_query($koneksi, $update)) {
        echo "<script>alert('Data berhasil diperbarui!');window.location='data_siswa.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Siswa</title>
    <style>
        body {font-family: 'Poppins', sans-serif; background: #f4f6f8;}
        .container {
            background: white; width: 600px; margin: 50px auto;
            padding: 25px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        h2 {text-align:center; color:#3c91e6;}
        input, textarea, select {
            width:100%; padding:8px; margin-top:5px; border:1px solid #ccc; border-radius:6px;
        }
        button {
            background:#3c91e6; color:white; border:none; border-radius:6px;
            padding:10px; margin-top:20px; cursor:pointer;
        }
        button:hover {background:#347dc7;}
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Data Siswa</h2>
        <form method="POST">
            <label>NIS</label>
            <input type="text" name="nis" value="<?= $data['nis'] ?>" required>

            <label>Nama Lengkap</label>
            <input type="text" name="nama_siswa" value="<?= $data['nama_siswa'] ?>" required>

            <label>Kelas</label>
            <input type="text" name="kelas" value="<?= $data['kelas'] ?>" required>

            <label>Alamat</label>
            <textarea name="alamat" required><?= $data['alamat'] ?></textarea>

            <label>No. HP</label>
            <input type="text" name="no_telp" value="<?= $data['no_telp'] ?>" required>

            <label>Status</label>
            <select name="status" required>
                <option value="Aktif" <?= $data['status']=='Aktif'?'selected':'' ?>>Aktif</option>
                <option value="Nonaktif" <?= $data['status']=='Nonaktif'?'selected':'' ?>>Nonaktif</option>
            </select>

            <button type="submit" name="update">Update Data</button>
        </form>
    </div>
</body>
</html>
