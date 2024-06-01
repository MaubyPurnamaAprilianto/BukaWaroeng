<?php
session_start();
include 'koneksi.php';
$id = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM user WHERE id = $id");

if ($query) {
  echo "<script>alert('Data Berhasil dihapus'); window.location='data_user.php';</script>";
} else {
  echo "<script>alert('Data Gagal dihapus'); window.location='data_user.php';</script>";
}