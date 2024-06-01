<?php
session_start();
include 'koneksi.php';
$id = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM kategori WHERE id = '$id'");

if ($query) {
  echo "<script>alert('Data Berhasil dihapus'); window.location='data_kategori.php';</script>";
} else {
  echo "<script>alert('Data Tidak Berasil dihapus'); window.location='data_kategori.php';</script>";
}
?>