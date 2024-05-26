<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

$id = $_GET['id'];

$name = $_POST['nama'];
$harga = $_POST['harga'];
$decs = $_POST['deskripsi'];
$foto = $_FILES['gambar']['name'];

// menampung data file yang diupload
$tmp_name = $_FILES['gambar']['tmp_name'];

if($foto != ''){
  $type1 = explode('.', $foto);
  $type2 = $type1[1];

  $newname = 'produk'.time().'.'.$type2;

  // menampung data format file yang diizinkan
  $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

  // validasi format file
  if(!in_array($type2, $tipe_diizinkan)){
    // jika format file tidak ada di dalam tipe diizinkan
    echo '<script>alert("Format file tidak diizinkan")</script>';

  }else{
    // Hapus gambar lama dari direktori
    $query_select = "SELECT produk_image FROM produk WHERE id = '$id'";
    $result_select = mysqli_query($conn, $query_select);
    $row = mysqli_fetch_assoc($result_select);
    $old_image = $row['produk_image'];
    unlink('produk/'.$old_image);

    // Upload gambar baru
    move_uploaded_file($tmp_name, 'produk/'.$newname);
    $namagambar = $newname;
  }

}else{
  // jika admin tidak ganti gambar
  $namagambar = $_POST['foto'];
}

$query = "UPDATE produk SET produk_nama = '$name', produk_harga = '$harga', produk_deksripsi = '$decs', produk_image = '$namagambar' WHERE id = '$id'";
$result = mysqli_query($conn, $query);
if($result){
  echo '<script>alert("Data Produk Berhasil")</script>';
  echo '<script>window.location="data_produk.php"</script>';
} else {
  echo '<script>alert("Data Produk Tidak Berhasil")</script>';
  echo '<script>window.location="tambah_produk.php"</script>';
}
?>
