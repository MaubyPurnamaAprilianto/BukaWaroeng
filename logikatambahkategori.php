<?php
session_start();
include 'koneksi.php';
// tambah kategori

$kategori = $_POST['kategori'];

$query = mysqli_query($conn, "INSERT INTO kategori (kategori_name) VALUES ('$kategori')");

if ($query) {
  echo '<script>alert("Data Kategori Berhasil")</script>';
  header("location: data_kategori.php");
} else {
  echo '<script>alert("Data Kategori Gagal Ditambahkan")</script>';
  header("location: tambah-data-kategori.php");
}