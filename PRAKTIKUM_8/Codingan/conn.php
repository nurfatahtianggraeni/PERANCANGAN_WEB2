<?php
$conn = mysqli_connect("localhost", "root", "", "pagination");
if (!$conn) {
die("Koneksi gagal: " . mysqli_connect_error());
}
?>