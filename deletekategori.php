<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

$id = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM kategori WHERE id = '$id'");

if ($query) {
  echo "<script>alert('Data Berhasil dihapus'); window.location='data_kategori.php';</script>";
} else {
  echo "<script>alert('Data Tidak Berasil dihapus'); window.location='data_kategori.php';</script>";
}
?>