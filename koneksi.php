<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

// Memeriksa apakah koneksi berhasil
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
