<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$no_hp = '';
$alamat = '';
$level = 2; // Menentukan level default sebagai 2

$query = mysqli_query($conn, "INSERT INTO user (name, username, password, nomer_hp, email, alamat,level) VALUES ('$name', '$username', '$password', '$no_hp', '$email', '$alamat', '$level')");

if ($query) {
  header("location: login.php");
} else {
  echo "Gagal";
}
?>
