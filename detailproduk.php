<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

if ($_SESSION["login"] !== true) {
  echo "<script>window.location='login.php'</script>";
  exit;
}

$id = $_GET["id"];
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
$data = mysqli_fetch_assoc($query);
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
<body class="bg-gray-100">
<nav class="w-full h-16 bg-gray-800 px-6 flex justify-between items-center text-white z-10">
    <div>
      <a class="text-3xl font-bold" href="index.php">Toko BukaWaroeng</a>
    </div>
    <!-- <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->
    <div>
      <ul class="flex gap-4">
        <li class="">
          <a class="hover:text-gray-500" href="admin.php">Home</a>
        </li>
        <li class="">
          <a class="hover:text-gray-500" href="about.php">About</a>
        </li>
        <li class="">
          <a class="hover:text-gray-500" href="produk.php">Product</a>
        </li>
        <li>
          <!-- <a href="login.php" class="btn-light px-4 py-2 font-bold  rounded-lg">Login</a> -->
          <a class="hover:text-gray-500" href="profiluser.php">Profil</a>
        </li>
        <li>
          <a href="logikalogout.php" class="btn px-4 py-2 hover:text-white rounded-lg">Logout</a>
        </li>
      </ul>
    </div>
</nav>

<!-- buat kan saya detail produk -->
<div class="w-full h-screen flex justify-center flex-col items-center">
  <h1 class="text-3xl font-bold">Detail Produk</h1>
  <div class="bg-white border border-gray-500 w-[80%] h-[80vh] mb-10 py-10">
      <div class="w-full h-full flex">
        <div class="w-[50%] flex justify-center items-center">
            <img src="produk/<?= $data["produk_image"] ?>" alt="" width="300px">
        </div>
        <div class="w-[50%] flex flex-col">
          <h1 class="text-2xl font-semibold tracking-[0.1em] mb-3"><?= $data["produk_nama"] ?></h1>
          <p class="text-xl text-red-500 font-semibold mb-3">Rp. <?= $data["produk_harga"] ?></p>
          <p class="text-gray-500 mb-3">Deskripsi :</p>
          <p class="text-lg"><?= $data["produk_deksripsi"] ?></p>
        </div>
      </div>
  </div>
</div>



<!-- Buat Kan Saya Footer -->
<footer class="w-full h-64 bg-gray-800">
  <div class="w-full h-full px-10 flex justify-between items-center text-white">
    <div class="w-[40%]">
      <a href="#" class="text-3xl font-bold">Toko BukaWaroeng</a>
      <p class="mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla itaque unde enim iste pariatur earum aut natus, tempore at adipisci.</p>
    </div>
    <div>
      <ul class="flex gap-10">
          <li class="">
            <a class="hover:text-gray-500" href="index.php">Home</a>
          </li>
          <li class="">
            <a class="hover:text-gray-500" href="about.php">About</a>
          </li>
          <li class="">
            <a class="hover:text-gray-500" href="contact.php">Category</a>
          </li>
          <li class="">
            <a class="hover:text-gray-500" href="contact.php">Produk</a>
          </li>
        </ul>
        <p class="mt-6 text-right">
          Copyright &copy; 2022. All rights reserved.
        </p>
    </div>
  </div>
</footer>
</body>
</html>