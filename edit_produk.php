<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

if ($_SESSION["login"] !== true) {
    echo "<script>window.location='login.php'</script>";
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$_GET[id]'");
$data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bukawarung</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="index.css">
</head>

<body class="bg-gray-100">
  <!-- content -->
  <div class="flex justify-center items-center my-8">
    <div class="w-[80%] bg-white p-8 rounded shadow">
      <h3 class="text-2xl font-semibold mb-4">Tambah Data Produk</h3>
      <div class="">
        <form action="logikaeditproduk.php?id=<?= $data['id'] ?>" method="POST" enctype="multipart/form-data">
          <div class="mb-4">
            <input type="text" name="nama" class="text-[14px] border border-gray-300 px-3 py-2 w-full  rounded px-4 mb-4"
              placeholder="Nama Produk" value="<?= $data['produk_nama'] ?>" required>
          </div>
          <div class="mb-4">
            <input type="text" name="harga" class="text-[14px] border border-gray-300 px-3 py-2 w-full  rounded px-4 mb-4"
              placeholder="Harga" value="<?= $data['produk_harga'] ?>" required>
          </div>
          <div class="mb-4">
          <img src="produk/<?= $data['produk_image'] ?>" width="100px">
          <input type="hidden" name="foto" value="<?= $data['produk_image']?>">
            <input type="file" name="gambar" >
          </div>
          <div class="mb-4">
            <textarea class="input-control w-full h-40 px-3 py-2 border border-gray-300 rounded" name="deskripsi"
              placeholder="Deskripsi"> <?= $data['produk_deksripsi'] ?></textarea><br>
          </div>
          <!-- <div class="mb-4">
            <select class="input-control w-full px-3 py-2 border border-gray-300 rounded" name="status">
              <option value="">--Pilih--</option>
              <option value="1">Aktif</option>
              <option value="0">Tidak Aktif</option>
            </select>
          </div> -->
          <div>
            <input type="submit" name="submit" value="Submit"
              class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>