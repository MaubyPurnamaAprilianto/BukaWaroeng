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

  <nav class="w-full h-16 bg-gray-800 flex justify-between items-center text-white px-6">
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

  <!-- content -->
  <div class="flex justify-center items-center my-8">
    <div class="w-[80%] bg-white p-8 rounded shadow">
      <h3 class="text-2xl font-semibold mb-4">Edit Data Kategori</h3>
      <div>
        <form action="logikatambahkategori.php" method="POST" enctype="multipart/form-data">
          <div class="mb-4">
            <input type="text" name="kategori" class="text-[14px] border border-gray-300 px-3 py-2 w-full rounded mb-4" placeholder="Nama Kategori" required>
          </div>
          <div>
            <input type="submit" name="submit" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
          $kategori = $_POST['kategori'];
          $sql = "INSERT INTO kategori (kategori_name) VALUES ('$kategori')";
          $query = mysqli_query($conn, $sql);

          if ($query) {
            echo "<script>alert('Data Berhasil');window.location='data-kategori.php';</script>";
          } else {
            echo "<script>alert('Data Gagal Disimpan');window.location='data-kategori.php';</script>";
          }
        }
        ?>
      </div>
    </div>
  </div>

</body>

</html>