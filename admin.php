<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

if ($_SESSION["login"] !== true) {
  echo "<script>window.location='login.php'</script>";
  exit;
}

$query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$_SESSION[id]'");
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Katalog Produk</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">-->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="index.css">
</head>
<body>
<nav class="w-full h-16 bg-gray-800 px-6 flex justify-between items-center text-white fixed z-10">
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

<div class="w-full h-screen flex justify-center items-center px-[10%]">
    <div class="w-full h-[55%] flex justify-center items-center flex-col bg-[#f2f2f2] rounded-lg p-[10%] text-center">
      <h3 class="text-2xl font-bold mb-4">Selamat Datang <?= $row['name']; ?> Di Toko BukaWaroeng</h3>
      <p>Aplikasi Katalog Produk – Jadikan tokomu selalu update dalam mengelola pesanan dan persedian produk dengan menggunakan BukaWaroeng. </p>
    </div>
  </div>

<!-- buat kan saya seacrh -->
<div class="w-full h-[13vh] flex justify-center border-b border-gray-300 py-4 gap-2">
  <input type="text" placeholder="Cari Produk" class="w-[50%] border border-gray-500 p-2 rounded-lg">
  <button class="btn px-4 py-1 hover:text-white hover:bg-gray-500 rounded-lg">search</button>
</div>

<!-- buat kan saya kategory -->
<div class="w-full h-16 px-10 flex justify-between items-center">
  <h1 class="text-xl font-bold">Kategori</h1>
  <ul class="flex gap-4 items-center">
    <li><a class="hover:text-gray-500" href="index.php">All</a></li>
    <li><a class="hover:text-gray-500" href="index.php">Makanan</a></li>
    <li><a class="hover:text-gray-500" href="index.php">Minuman</a></li>
    <li class="relative group">
      <select name="HeadlineAct" id="HeadlineAct" class="px-2 py-1 font-semibold rounded-lg border-gray-300 text-gray-700 sm:text-sm">
        <option value="">Pilih Kategori</option>
        <option value="">Sepatu</option>
        <option value="">Sepatu</option>
        <option value="">Sepatu</option>
      </select>
    </li>
  </ul>
</div>

<!-- buat kan card produk -->
<div>
  <div class="w-full flex flex-wrap justify-center items-center gap-4 ">
    <div class="bg-white rounded-lg shadow-lg w-[30%] h-[70vh] p-4 flex justify-center items-center flex-col">
      <div>
        <img src="asset/img/produk1.png" alt="" width="250px">
      </div>
      <div class="w-full">
        <p class="text-2xl font-bold tracking-[0.1em] uppercase ">Kol </p>
        <p class="text-xl text-right text-red-500 mb-3">Rp. 100.000</p>

      </div>
    </div>
    <div class="bg-white rounded-lg shadow-lg w-[30%] h-[70vh] p-4 flex justify-center items-center flex-col"></div>
    <div class="bg-white rounded-lg shadow-lg w-[30%] h-[70vh] p-4 flex justify-center items-center flex-col"></div>
    <div class="bg-white rounded-lg shadow-lg w-[30%] h-[70vh] p-4 flex justify-center items-center flex-col"></div>
    <div class="bg-white rounded-lg shadow-lg w-[30%] h-[70vh] p-4 flex justify-center items-center flex-col"></div>
    <div class="bg-white rounded-lg shadow-lg w-[30%] h-[70vh] p-4 flex justify-center items-center flex-col"></div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>