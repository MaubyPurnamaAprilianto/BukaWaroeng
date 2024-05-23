<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

$name = $_POST['nama'];
$harga = $_POST['harga'];
$decs = $_POST['deskripsi'];
$image = $_FILES['gambar']['name'];

$query = "INSERT INTO produk ( produk_nama, produk_harga, produk_deksripsi, produk_image) VALUES ( '$name', '$harga', '$decs', '$image')";
$result = mysqli_query($conn, $query);

if ($result) {
  move_uploaded_file($_FILES['image']['tmp_name'], 'produk/' . $image);
  header('Location: tambah_produk.php');
} else {
  echo "Failed";
}

?>