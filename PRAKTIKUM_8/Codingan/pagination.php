<?php
include('conn.php');


// Hitung total film
$query = mysqli_query($conn, "SELECT COUNT(movieid) FROM movie");
$row = mysqli_fetch_row($query);
$total_rows = $row[0];


// Pengaturan pagination
$rows_per_page = 5; // ubah jika ingin lebih/kurang
$last_page = ceil($total_rows / $rows_per_page);
if ($last_page < 1) $last_page = 1;


// Tangkap parameter halaman
$pagenum = isset($_GET['pn']) ? (int)$_GET['pn'] : 1;
if ($pagenum < 1) $pagenum = 1;
else if ($pagenum > $last_page) $pagenum = $last_page;


// Ambil data sesuai halaman
$limit = "LIMIT " . ($pagenum - 1) * $rows_per_page . "," . $rows_per_page;
$data = mysqli_query($conn, "SELECT * FROM movie $limit");


// Generate kontrol pagination (Previous, angka, Next)
$pagination = "";
if ($last_page != 1) {
// Previous
if ($pagenum > 1) {
$previous = $pagenum - 1;
$pagination .= "<a class='btn-nav' href='?pn=$previous'>&laquo; Prev</a>";
}


// halaman angka (tampilkan beberapa angka di sekitar current)
$start = $pagenum - 2;
if ($start < 1) $start = 1;
$end = $pagenum + 2;
if ($end > $last_page) $end = $last_page;


for ($i = $start; $i <= $end; $i++) {
if ($i == $pagenum) {
$pagination .= " <span class='btn-current'>$i</span> ";
} else {
$pagination .= " <a class='btn-page' href='?pn=$i'>$i</a> ";
}
}


// Next
if ($pagenum < $last_page) {
$next = $pagenum + 1;
$pagination .= "<a class='btn-nav' href='?pn=$next'>Next &raquo;</a>";
}
}
?>