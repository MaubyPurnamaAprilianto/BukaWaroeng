<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = md5($_POST['password']); // Diganti ke md5 agar password disimpan dalam bentuk md5
$no_hp = '';
$alamat = '';
$level = 2; // Menentukan level default sebagai 2

$query_username = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
$query_email = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

if (mysqli_num_rows($query_username) > 0) {
    echo '<script>alert("Username sudah ada");window.location="registar.php";</script>';
}
else if (mysqli_num_rows($query_email) > 0) {
    echo '<script>alert("Email sudah ada");window.location="registar.php";</script>';
}
else {
    $query = mysqli_query($conn, "INSERT INTO user (name, username, password, nomer_hp, email, alamat,level) VALUES ('$name', '$username', '$password', '$no_hp', '$email', '$alamat', '$level')");
    if ($query) {
        header("location: login.php");
    } else {
        echo "Gagal";
    }
}

