<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="index.css">
</head>
<body>
<nav class="w-full h-16 bg-gray-800 flex justify-between items-center text-white px-6 ">
    <div>
      <a href="dashboard.php" class="text-3xl font-bold">Toko BukaWaroeng</a>
    </div>
    <div>
      <ul class="flex gap-6">
        <li><a href="dashboard.php" class="hover:text-gray-500">Dashboard</a></li>
        <li><a href="profil.php" class="hover:text-gray-500">Profil</a></li>
        <li><a href="data_kategori.php" class="hover:text-gray-500">Data kategori</a></li>
        <li><a href="data_produk.php" class="hover:text-gray-500">Data Produk</a></li>
        <li><a href="logikalogout.php" class="btn px-4 py-2 hover:text-white rounded-lg">Logout</a></li>
      </ul>
    </div>
  </nav>

  <!-- buat kan saya table produk dengan column no nama produk , harga,deksripsi,image -->
  <div class="w-full h-screen flex  flex-col items-left p-10">
    <h1 class="text-3xl font-bold mb-6">Data Produk</h1>
    <div>
      <a href="tambah_produk.php" class="bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 rounded-lg">Tambah</a>
    </div>
    <table class="table w-full mt-6 border border-gray-300" cellspacing="0" cellpadding="10">
      <tr>
        <th class="border border-gray-300 w-[60px]">No</th>
        <th class="border border-gray-300">Produk</th>
        <th class="border border-gray-300">Deskripsi</th>
        <th class="border border-gray-300">Harga</th>
        <th class="border border-gray-300">Gambar</th>
        <th class="border border-gray-300 ">Aksi</th>
      </tr>

      <?php
      $no = 1;
      $conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");
      $query = mysqli_query($conn, "SELECT * FROM produk");
      while($data = mysqli_fetch_array($query)) {
      ?>
      <tr>
        <td class="border border-gray-300"><?= $no++ ?></td>
        <td class="border border-gray-300"><?= $data['produk_nama'] ?></td>
        <td class="border border-gray-300"><?= $data['produk_deksripsi'] ?></td>
        <td class="border border-gray-300">Rp. <?php echo number_format($data['produk_harga']) ?></td>
        <td class="flex justify-center border border-gray-300"><a href="produk/<?php echo $data['produk_image'] ?>" target="_blank"> <img src="produk/<?php echo $data['produk_image'] ?>" width="50px"> </a></td>
        <td class="border border-gray-300">
          <a href="edit_produk.php?id=<?= $data['id'] ?>" class="bg-green-500 px-4 py-2 text-white hover:bg-green-600 rounded-lg">Edit</a>
          <a href="delete_produk.php?id=<?= $data['id'] ?> " onclick="return confirm('Yakin ingin hapus ?')" class="bg-red-500 px-4 py-2 text-white hover:bg-red-700 rounded-lg">Delete</a>
        </td>
      </tr>

      <?php } ?>
    </table>
  </div>
</body>
</html>