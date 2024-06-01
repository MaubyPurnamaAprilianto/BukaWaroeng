<?php
session_start();
include 'koneksi.php';
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="index.css">
</head>

<body class="bg-gray-100">
  <header class="bg-gray-800  w-full z-10">
    <div class="mx-auto flex h-16 max-w-screen-xl items-center justify-between gap-8 px-4 sm:px-6 lg:px-8">
      <button id="menu-toggle"
        class="block rounded hover:bg-gray-700 p-2.5 text-gray-300 transition hover:text-white md:hidden">
        <span class="sr-only">Toggle menu</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
          stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
      <a class="block text-teal-600 mx-auto md:mx-0" href="#">
        <h1 class="text-[15px] sm:text-2xl font-bold text-white">BUKA<span class="text-blue-600">WAROENG</span></h1>
      </a>
      <div class="hidden md:flex flex flex-1 items-center justify-end md:justify-between">
        <ul class="hidden md:flex items-center  flex flex-row gap-2 text-sm">
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75 px-4 py-3 " id="active"
              href="admin.php"> Dashboard </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75 py-3 px-4" href="profiluser.php"> Profil </a>
          </li>
          <!-- <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="category.php"> Category </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="profiluser.php"> Product </a>
          </li> -->
        </ul>
      </div>

      <div class=" flex items-center gap-4">
        <div class="hidden md:flex justify-center gap-2">
          <form method="GET" class="flex w-full items-center gap-2 my-4">
            <input type="text" name="search" placeholder="Cari Produk"
              class="bg-gray-700 text-white px-4 py-3 h-8 rounded-md text-xs focus:shadow-outline">
            <button class="bg-blue-600 px-2 py-1 h-8  hover:text-white hover:bg-blue-700 rounded-md">
              <i class="fa-solid fa-magnifying-glass text-white"></i>
            </button>
          </form>
        </div>
        <div class="sm:flex sm:gap-4">
          <a class="block rounded-md bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700"
            href="logikalogout.php">
            Logout
          </a>
          <!-- <a class=" rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-blue-600 transition hover:text-blue-600/75 sm:block" href="registar.php">
            Register
          </a> -->
        </div>
      </div>
    </div>
    <div id="mobile-menu" class="md:hidden hidden">
      <nav aria-label="Mobile" class="px-4 py-2">
        <ul class="flex flex-col gap-2 text-sm">
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="admin.php"> Dashboard </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="profiluser.php"> Profil </a>
          </li>
          <!-- <li class="border-b border-gray-100 w-full pb-2">
            <a class="text-white transition hover:text-gray-500/75" href="data_produk.php"> Data Produk </a>
          </li>
          <li class="border-b border-gray-100 w-full pb-2">
            <a class="text-white transition hover:text-gray-500/75" href="profil.php"> Profil </a>
          </li> -->
          <li>
            <form method="GET" class="flex w-full items-center gap-2 my-4 ">
              <input type="text" name="search" placeholder="Cari Produk"
                class="bg-gray-700 w-full text-white px-4 py-2 rounded-md text-sm focus:shadow-outline">
              <button class="bg-blue-600 px-3 py-2 rounded-md hover:bg-blue-700">
                <i class="fa-solid fa-magnifying-glass text-white"></i>
              </button>
            </form>
          </li>
        </ul>
      </nav>
    </div>
    <nav aria-label="Global" class="hidden md:block">
      <ul class="hidden md flex items-center gap-6 text-sm">
        <li>
          <a class="text-gray-500 transition hover:text-gray-500/75" id="active" href="admin.php"> Dashboard </a>
        </li>
        <li>
          <a class="text-gray-500 transition hover:text-gray-500/75" href="profiluser.php"> Profil </a>
        </li>
        <!-- <li>
          <a class="text-gray-500 transition hover:text-gray-500/75" href="data_produk.php"> Data Produk </a>
        </li>
        <li>
          <a class="text-gray-500 transition hover:text-gray-500/75" href="profil.php"> Profil </a>
        </li> -->
        <li class="hidden md:flex items-center">
          <form method="GET" class="flex items-center gap-2">
            <input type="text" name="search" placeholder="Cari Produk"
              class="bg-gray-700 text-white px-4 py-2 rounded-md text-sm focus:shadow-outline">
            <button class="bg-blue-600 px-2 py-2 rounded-md hover:bg-blue-700">
              <i class="fa-solid fa-magnifying-glass text-white"></i>
            </button>
          </form>
        </li>
      </ul>
    </nav>
  </header>

  <!-- buat kan saya detail produk -->
  <div class="w-full h-screen flex justify-center flex-col items-center">
    <!-- <h1 class="text-3xl font-bold">Detail Produk</h1> -->
    <div class="bg-white border border-gray-500 w-[80%] h-[80vh] mb-10 py-10 rounded-md">
      <div class="w-full h-full flex">
        <div class="w-[50%] flex justify-center items-center">
          <img
            src="produk/<?= $data["produk_image"] ?>"
            alt="" width="300px">
        </div>
        <div class="w-[50%] flex flex-col">
          <h1 class="text-2xl font-semibold tracking-[0.1em] mb-3 uppercase">
            <?= $data["produk_nama"] ?></h1>
          <p class="text-xl text-red-500 font-semibold mb-3">Rp.
            <?= $data["produk_harga"] ?></p>
          <p class="text-gray-500 mb-3">Deskripsi :</p>
          <p class="text-lg">
            <?= $data["produk_deksripsi"] ?></p>
        </div>
      </div>
    </div>
  </div>



  <!-- Buat Kan Saya Footer -->
  <footer class="w-full h-64 bg-gray-800">
    <div class="w-full h-full px-10 flex justify-between items-center text-white">
      <div class="w-[40%]">
        <a class="block text-teal-600 mx-auto md:mx-0" href="#">
          <h1 class="text-[15px] sm:text-2xl font-bold text-white">BUKA<span class="text-blue-600">WAROENG</span></h1>
        </a>
        <p class="mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla itaque unde enim iste pariatur
          earum aut natus, tempore at adipisci.</p>
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