<?php

session_start();

$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $_SESSION['username'] = $row['username'];
  $_SESSION['password'] = $row['password'];
  header("Location: admin.php");
} else {
  header("Location: passsalah.php");
}