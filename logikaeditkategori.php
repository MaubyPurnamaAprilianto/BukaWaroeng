<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $kat = $_POST['kategori'];
    $update = mysqli_query($conn, "UPDATE kategori SET kategori_name = '$kat' WHERE id = '$id'");
    if ($update) {
        echo '<script>alert("Data Kategori Berhasil Diedit"); window.location="data_kategori.php";</script>';
    } else {
        echo '<script>alert("Data Kategori Tidak Berhasil Diedit"); window.location="logikaeditkategori.php?id='.$id.'";</script>';
    }
} 
?>
