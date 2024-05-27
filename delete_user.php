<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

$id = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM user WHERE id = $id");

if ($query) {
  echo "<script>alert('Data Berhasil dihapus'); window.location='data_user.php';</script>";
} else {
  echo "<script>alert('Data Gagal dihapus'); window.location='data_user.php';</script>";
}