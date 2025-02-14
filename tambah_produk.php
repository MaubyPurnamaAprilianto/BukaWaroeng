<?php
session_start();
include 'koneksi.php';
if ($_SESSION["login"] !== true) {
    echo "<script>window.location='login.php'</script>";
    exit;
}
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
        <form action="logikatambahproduk.php" method="POST" enctype="multipart/form-data">
          <div class="mb-4">
            <select class=" w-full px-3 py-2 border border-gray-300 rounded" name="kategori" required>
              <option value="">--Pilih--</option>
              <?php
              $kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id DESC");
              while ($data = mysqli_fetch_array($kategori)) {
              ?>
              <option value="<?= $data['id'] ?>"><?= $data['kategori_name'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="mb-4">
            <input type="text" name="nama" class="text-[14px] border border-gray-300 px-3 py-2 w-full  rounded px-4 mb-4"
              placeholder="Nama Produk" required>
          </div>
          <div class="mb-4">
            <input type="text" name="harga" class="text-[14px] border border-gray-300 px-3 py-2 w-full  rounded px-4 mb-4"
              placeholder="Harga" required>
          </div>
          <div class="mb-4">
            <input type="file" name="gambar" class=""
              required>
          </div>
          <div class="mb-4">
            <textarea class="input-control w-full h-40 px-3 py-2 border border-gray-300 rounded" name="deskripsi"
              placeholder="Deskripsi"></textarea><br>
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