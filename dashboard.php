<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

if ($_SESSION["login"] !== true) {
  echo "<script>window.location='login.php'</script>";
  exit;
}

$query = "SELECT * FROM user";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

?>
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

  <!-- content -->

  <div class="w-full h-screen flex justify-center px-[5%]">
    <div class="w-full rounded-lg p-8">
      <h3 class="text-2xl">Dashboard</h3>
      <div class="text-xl border border-gray-500 rounded-lg p-4">
        Selamat Datang <?= $row['name']; ?> (<?= $row['username']; ?>) di Toko BukaWaroeng
      </div>
    </div>
  </div>
</body>
</html>