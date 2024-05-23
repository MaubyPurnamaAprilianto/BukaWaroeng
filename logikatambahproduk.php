<?php

session_start();
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

$name = $_POST['nama'];
$harga = $_POST['harga'];
$decs = $_POST['deskripsi'];

// menampung data file yang diupload
$filename = $_FILES['gambar']['name'];
$tmp_name = $_FILES['gambar']['tmp_name'];

$type1 = explode('.', $filename);
$type2 = $type1[1];

$newname = 'produk'.time().'.'.$type2;

// menampung data format file yang diizinkan
$allowtype = array('jpg', 'jpeg', 'png', 'gif');

if (!in_array($type2, $allowtype)) {
  echo "Type file tidak diizinkan";
} else {
  move_uploaded_file($tmp_name, 'produk/' . $newname);

  $query = "INSERT INTO produk ( produk_nama, produk_harga, produk_deksripsi, produk_image) VALUES ( '$name', '$harga', '$decs', '$newname')";
  $result = mysqli_query($conn, $query);
  if ($result) {
      move_uploaded_file($_FILES['image']['tmp_name'], 'produk/' . $image);
      header('Location: data_produk.php');
  } else {
      echo "Failed";
  }
}


