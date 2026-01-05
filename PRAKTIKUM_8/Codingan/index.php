<?php include('pagination.php'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Daftar Film — Pagination</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<style>
body{ background: linear-gradient(135deg,#eef2f7 0%, #ffffff 100%); font-family: 'Poppins', Arial, sans-serif; }
.header{ text-align:center; padding:30px 15px; }
.card-table{ max-width:1000px; margin:20px auto; border-radius:12px; box-shadow:0 10px 30px rgba(50,50,93,0.08); overflow:hidden; }
.table thead th{ background:linear-gradient(90deg,#6a11cb,#2575fc); color:#fff; border:none; }
.table tbody tr:hover{ background:#f8fbff; }
.btn-nav, .btn-page, .btn-current{ padding:8px 12px; margin:3px; border-radius:8px; text-decoration:none; display:inline-block; }
.btn-nav{ background:#2575fc; color:white; }
.btn-page{ background:#e9f0ff; color:#2575fc; }
.btn-current{ background:#1f3bb3; color:#fff; font-weight:600; }
.summary{ text-align:center; color:#6b7280; margin-top:8px; }
.badge-genre{ font-size:12px; padding:6px 8px; border-radius:8px; }
</style>
</head>
<body>
<div class="header">
<h1>Daftar Film Populer</h1>
<p class="summary">Menampilkan film per halaman. Gunakan tombol untuk berpindah halaman.</p>
</div>


<div class="card card-table">
<div class="card-body">
<div class="table-responsive">
<table class="table align-middle mb-0">
<thead>
<tr>
<th style="width:80px;">#</th>
<th>Judul</th>
<th style="width:160px;">Genre</th>
<th style="width:120px;">Tahun</th>
</tr>
</thead>
<tbody>
<?php while($row = mysqli_fetch_array($data)) { ?>
<tr>
<td><?= htmlspecialchars($row['movieid']); ?></td>
<td><strong><?= htmlspecialchars($row['title']); ?></strong></td>
<td><span class="badge-genre bg-light border"><?= htmlspecialchars($row['genre']); ?></span></td>
<td><?= htmlspecialchars($row['year']); ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>


<div class="d-flex justify-content-center mt-3">
<?= $pagination; ?>
</div>
</div>
</div>


</body>
</html>