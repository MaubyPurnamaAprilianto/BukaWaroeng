<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

$id = $_GET['id'];

// Periksa apakah id ada dalam URL
if(isset($id)) {
    // Lakukan kueri untuk mendapatkan data produk
    $query = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");

    // Periksa apakah ada hasil dari kueri
    if(mysqli_num_rows($query) > 0) {
        // Ambil data produk
        $data = mysqli_fetch_assoc($query);

        // Hapus gambar terkait dengan produk
        unlink("produk/" . $data['image']);

        // Lakukan kueri DELETE untuk menghapus produk dari database
        mysqli_query($conn, "DELETE FROM produk WHERE id = $id");

        // Tampilkan pesan sukses menggunakan JavaScript
        echo "<script>alert('Data Berhasil dihapus'); window.location='data_produk.php';</script>";
    } else {
        // Jika tidak ada data dengan id yang diberikan
        echo "<script>alert('Data tidak ditemukan'); window.location='data_produk.php';</script>";
    }
} else {
    // Jika parameter 'id' tidak ada dalam URL
    echo "<script>alert('Parameter id tidak ditemukan'); window.location='data_produk.php';</script>";
}
?>
