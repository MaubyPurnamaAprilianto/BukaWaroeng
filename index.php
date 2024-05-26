<?php
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");
session_start();


// Pagination variables
$limit = 8; // Number of products per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Search functionality
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Fetch total number of products with search filter
$total_query = "SELECT COUNT(*) AS total FROM produk WHERE produk_nama LIKE '%$search%'";
$total_result = mysqli_query($conn, $total_query);
$total_rows = mysqli_fetch_assoc($total_result)['total'];
$total_pages = ceil($total_rows / $limit);

// Fetch products for the current page with search filter
$queryproduk = mysqli_query($conn, "SELECT * FROM produk WHERE produk_nama LIKE '%$search%' LIMIT $limit OFFSET $offset");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Katalog Produk</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">-->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="index.css">
  <style>
        .hidden { display: none; }
    </style>
</head>
<body>
<header class="bg-gray-800   w-full z-10">
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
        <span class="sr-only">Home</span>
        <svg class="h-8" viewBox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M0.41 10.3847C1.14777 7.4194 2.85643 4.7861 5.2639 2.90424C7.6714 1.02234 10.6393 0 13.695 0C16.7507 0 19.7186 1.02234 22.1261 2.90424C24.5336 4.7861 26.2422 7.4194 26.98 10.3847H25.78C23.7557 10.3549 21.7729 10.9599 20.11 12.1147C20.014 12.1842 19.9138 12.2477 19.81 12.3047H19.67C19.5662 12.2477 19.466 12.1842 19.37 12.1147C17.6924 10.9866 15.7166 10.3841 13.695 10.3841C11.6734 10.3841 9.6976 10.9866 8.02 12.1147C7.924 12.1842 7.8238 12.2477 7.72 12.3047H7.58C7.4762 12.2477 7.376 12.1842 7.28 12.1147C5.6171 10.9599 3.6343 10.3549 1.61 10.3847H0.41ZM23.62 16.6547C24.236 16.175 24.9995 15.924 25.78 15.9447H27.39V12.7347H25.78C24.4052 12.7181 23.0619 13.146 21.95 13.9547C21.3243 14.416 20.5674 14.6649 19.79 14.6649C19.0126 14.6649 18.2557 14.416 17.63 13.9547C16.4899 13.1611 15.1341 12.7356 13.745 12.7356C12.3559 12.7356 11.0001 13.1611 9.86 13.9547C9.2343 14.416 8.4774 14.6649 7.7 14.6649C6.9226 14.6649 6.1657 14.416 5.54 13.9547C4.4144 13.1356 3.0518 12.7072 1.66 12.7347H0V15.9447H1.61C2.39051 15.924 3.154 16.175 3.77 16.6547C4.908 17.4489 6.2623 17.8747 7.65 17.8747C9.0377 17.8747 10.392 17.4489 11.53 16.6547C12.1468 16.1765 12.9097 15.9257 13.69 15.9447C14.4708 15.9223 15.2348 16.1735 15.85 16.6547C16.9901 17.4484 18.3459 17.8738 19.735 17.8738C21.1241 17.8738 22.4799 17.4484 23.62 16.6547ZM23.62 22.3947C24.236 21.915 24.9995 21.664 25.78 21.6847H27.39V18.4747H25.78C24.4052 18.4581 23.0619 18.886 21.95 19.6947C21.3243 20.156 20.5674 20.4049 19.79 20.4049C19.0126 20.4049 18.2557 20.156 17.63 19.6947C16.4899 18.9011 15.1341 18.4757 13.745 18.4757C12.3559 18.4757 11.0001 18.9011 9.86 19.6947C9.2343 20.156 8.4774 20.4049 7.7 20.4049C6.9226 20.4049 6.1657 20.156 5.54 19.6947C4.4144 18.8757 3.0518 18.4472 1.66 18.4747H0V21.6847H1.61C2.39051 21.664 3.154 21.915 3.77 22.3947C4.908 23.1889 6.2623 23.6147 7.65 23.6147C9.0377 23.6147 10.392 23.1889 11.53 22.3947C12.1468 21.9165 12.9097 21.6657 13.69 21.6847C14.4708 21.6623 15.2348 21.9135 15.85 22.3947C16.9901 23.1884 18.3459 23.6138 19.735 23.6138C21.1241 23.6138 22.4799 23.1884 23.62 22.3947Z"
            fill="currentColor" />
        </svg>
       </a>
      <div class="hidden md:flex flex flex-1 items-center justify-end md:justify-between">
        <ul class="hidden md:flex items-center  flex flex-row gap-2 text-sm">
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="index.php"> Dashboard </a>
          </li>
          <!-- <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="about.php"> About </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="category.php"> Category </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="profiluser.php"> Product </a>
          </li> -->
        </ul>
      </div>
      
      <div class=" flex items-center gap-4">
        <div class="hidden md:flex justify-center gap-2">
          <input type="text" name="search" placeholder="Cari Produk" class="bg-gray-700 text-white px-4 py-3 h-8 rounded-md text-xs focus:shadow-outline">
          <button class="bg-blue-600 h1 px-2 hover:text-white hover:bg-blue-700 rounded-md">
          <i class="fa-solid fa-magnifying-glass text-white"></i>
          </button>
        </div>
        <div class="sm:flex sm:gap-4">
          <a class="block rounded-md bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700" href="login.php">
            Login
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
            <a class="text-gray-500 transition hover:text-gray-500/75" href="index.php"> Dashboard </a>
          </li>
          <!-- <li class="border-b border-gray-100 w-full pb-2"> 
            <a class="text-white transition hover:text-gray-500/75" href="data_kategori.php"> Data Kategori </a>
          </li>
          <li class="border-b border-gray-100 w-full pb-2">
            <a class="text-white transition hover:text-gray-500/75" href="data_produk.php"> Data Produk </a>
          </li>
          <li class="border-b border-gray-100 w-full pb-2">
            <a class="text-white transition hover:text-gray-500/75" href="profil.php"> Profil </a>
          </li> -->
          <li>
              <form method="GET" class="flex w-full items-center gap-2 my-4 ">
                  <input type="text" name="search" placeholder="Cari Produk" class="bg-gray-700 w-full text-white px-4 py-2 rounded-md text-sm focus:shadow-outline">
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
            <a class="text-gray-500 transition hover:text-gray-500/75" href="index.php"> Dashboard </a>
          </li>
        <!--<li>
          <a class="text-gray-500 transition hover:text-gray-500/75" href="data_kategori.php"> Data Kategori </a>
        </li>
        <li>
          <a class="text-gray-500 transition hover:text-gray-500/75" href="data_produk.php"> Data Produk </a>
        </li>
        <li>
          <a class="text-gray-500 transition hover:text-gray-500/75" href="profil.php"> Profil </a>
        </li> -->
        <li class="hidden md:flex items-center">
            <form method="GET" class="flex items-center gap-2">
                <input type="text" name="search" placeholder="Cari Produk" class="bg-gray-700 text-white px-4 py-2 rounded-md text-sm focus:shadow-outline">
                <button class="bg-blue-600 px-2 py-2 rounded-md hover:bg-blue-700">
                    <i class="fa-solid fa-magnifying-glass text-white"></i>
                </button>
            </form>
        </li>
      </ul>
    </nav>
  </header>
<!-- <header class="bg-gray-800">
  <div class="mx-auto flex h-16 max-w-screen-xl items-center gap-8 px-4 sm:px-6 lg:px-8">
    <a class="block text-teal-600" href="#">
      <span class="sr-only">Home</span>
      <svg class="h-8" viewBox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0.41 10.3847C1.14777 7.4194 2.85643 4.7861 5.2639 2.90424C7.6714 1.02234 10.6393 0 13.695 0C16.7507 0 19.7186 1.02234 22.1261 2.90424C24.5336 4.7861 26.2422 7.4194 26.98 10.3847H25.78C23.7557 10.3549 21.7729 10.9599 20.11 12.1147C20.014 12.1842 19.9138 12.2477 19.81 12.3047H19.67C19.5662 12.2477 19.466 12.1842 19.37 12.1147C17.6924 10.9866 15.7166 10.3841 13.695 10.3841C11.6734 10.3841 9.6976 10.9866 8.02 12.1147C7.924 12.1842 7.8238 12.2477 7.72 12.3047H7.58C7.4762 12.2477 7.376 12.1842 7.28 12.1147C5.6171 10.9599 3.6343 10.3549 1.61 10.3847H0.41ZM23.62 16.6547C24.236 16.175 24.9995 15.924 25.78 15.9447H27.39V12.7347H25.78C24.4052 12.7181 23.0619 13.146 21.95 13.9547C21.3243 14.416 20.5674 14.6649 19.79 14.6649C19.0126 14.6649 18.2557 14.416 17.63 13.9547C16.4899 13.1611 15.1341 12.7356 13.745 12.7356C12.3559 12.7356 11.0001 13.1611 9.86 13.9547C9.2343 14.416 8.4774 14.6649 7.7 14.6649C6.9226 14.6649 6.1657 14.416 5.54 13.9547C4.4144 13.1356 3.0518 12.7072 1.66 12.7347H0V15.9447H1.61C2.39051 15.924 3.154 16.175 3.77 16.6547C4.908 17.4489 6.2623 17.8747 7.65 17.8747C9.0377 17.8747 10.392 17.4489 11.53 16.6547C12.1468 16.1765 12.9097 15.9257 13.69 15.9447C14.4708 15.9223 15.2348 16.1735 15.85 16.6547C16.9901 17.4484 18.3459 17.8738 19.735 17.8738C21.1241 17.8738 22.4799 17.4484 23.62 16.6547ZM23.62 22.3947C24.236 21.915 24.9995 21.664 25.78 21.6847H27.39V18.4747H25.78C24.4052 18.4581 23.0619 18.886 21.95 19.6947C21.3243 20.156 20.5674 20.4049 19.79 20.4049C19.0126 20.4049 18.2557 20.156 17.63 19.6947C16.4899 18.9011 15.1341 18.4757 13.745 18.4757C12.3559 18.4757 11.0001 18.9011 9.86 19.6947C9.2343 20.156 8.4774 20.4049 7.7 20.4049C6.9226 20.4049 6.1657 20.156 5.54 19.6947C4.4144 18.8757 3.0518 18.4472 1.66 18.4747H0V21.6847H1.61C2.39051 21.664 3.154 21.915 3.77 22.3947C4.908 23.1889 6.2623 23.6147 7.65 23.6147C9.0377 23.6147 10.392 23.1889 11.53 22.3947C12.1468 21.9165 12.9097 21.6657 13.69 21.6847C14.4708 21.6623 15.2348 21.9135 15.85 22.3947C16.9901 23.1884 18.3459 23.6138 19.735 23.6138C21.1241 23.6138 22.4799 23.1884 23.62 22.3947Z" fill="currentColor"/>
      </svg>
    </a>
    <div class="flex flex-1 items-center justify-end md:justify-between">
      <nav aria-label="Global" class="hidden md:block">
        <ul class="flex items-center gap-6 text-sm">
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="index.php"> Home </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="about.php"> About </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="category.php"> Category </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="product.php"> Product </a>
          </li>
        </ul>
      </nav>

      <div class="flex items-center gap-4">
      <div class="flex justify-center gap-2">
        <input type="text" name="search" placeholder="Cari Produk" class="bg-gray-700 text-white px-4 py-3 h-8 rounded-md text-xs focus:shadow-outline">
        <button class="bg-blue-600 h1 px-2 hover:text-white hover:bg-blue-700 rounded-md">
        <i class="fa-solid fa-magnifying-glass text-white"></i>
        </button>
      </div>
        <div class="sm:flex sm:gap-4">
          <a class="block rounded-md bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700" href="login.php">
            Login
          </a>
          <a class="hidden rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-blue-600 transition hover:text-blue-600/75 sm:block" href="registar.php">
            Register
          </a>
        </div>

        <button class="block rounded bg-gray-100 p-2.5 text-gray-600 transition hover:text-gray-600/75 md:hidden">
          <span class="sr-only">Toggle menu</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</header> -->
<!-- <nav class="w-full h-16 bg-gray-800 px-6 flex justify-between items-center text-white">
    <div>
      <a class="text-3xl font-bold" href="index.php">Toko BukaWaroeng</a>
    </div>
<button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> 
    <div>
      <ul class="flex gap-4">
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
        <li>
          <a href="login.php" class="btn-light px-4 py-2 font-bold  rounded-lg">Login</a>
        </li>
        <li>
          <a href="registar.php" class="btn px-4 py-2 hover:text-white rounded-lg">Register</a>
        </li>
      </ul>
    </div>
</nav> -->
<!-- buat kan saya search
<div class="w-full h-[13vh] flex justify-center border-b border-gray-300 py-4 gap-2">
  <input type="text" placeholder="Cari Produk" class="w-[50%] border border-gray-500 p-2 rounded-lg">
  <button class="btn px-4 py-1 hover:text-white hover:bg-gray-500 rounded-lg">search</button>
</div> -->
<!-- banner -->
<section class="bg-gray-50">
  <div class="mx-auto max-w-screen-xl px-4 py-32 lg:flex lg:h-screen lg:items-center">
    <div class="mx-auto max-w-xl text-center">
      <h1 class="text-xl font-extrabold sm:text-3xl flex flex-row justify-center">
        Hello !  Welcome to   
        <span class="font-extrabold text-blue-700 sm:block"> Toko BukaWaroeng. </span>
      </h1>

      <p class="mt-4 sm:text-[1.1rem] sm:leading-relaxed">
      Aplikasi Katalog Produk – Jadikan tokomu selalu update dalam mengelola pesanan dan persedian produk dengan
        menggunakan BukaWaroeng.
      </p>

      <div class="mt-8 flex flex-wrap justify-center gap-4">
        <a
          class="block w-full rounded bg-blue-600 px-12 py-3 text-sm font-medium text-white shadow hover:bg-blue-700 focus:outline-none focus:ring active:bg-blue-500 sm:w-auto"
          href="#"
        >
          Get Started
        </a>

        <a
          class="block w-full rounded px-12 py-3 text-sm font-medium text-blue-600 shadow hover:text-blue-700 focus:outline-none focus:ring active:text-blue-500 sm:w-auto"
          href="#"
        >
          Learn More
        </a>
      </div>
    </div>
  </div>
</section>

<!-- about -->
<section>
  <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-16">
      <div class="relative h-64 overflow-hidden rounded-lg sm:h-80 lg:order-last lg:h-full">
        <img
          alt="A scenic view"
          src="https://images.unsplash.com/photo-1527529482837-4698179dc6ce?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
          class="absolute inset-0 h-full w-full object-cover"
        />
      </div>

      <div class="lg:py-24">
        <h2 class="text-3xl font-bold sm:text-4xl">Tentang Kami </h2>

        <p class="mt-4 text-gray-600">
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut qui hic atque tenetur quis
          eius quos ea neque sunt, accusantium soluta minus veniam tempora deserunt? Molestiae eius
          quidem quam repellat.
        </p>

        <a
          href="#"
          class="mt-8 inline-block rounded bg-indigo-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-yellow-400"
        >
          Get Started Today
        </a>
      </div>
    </div>
  </div>
</section>



<!-- buat kan saya kategory -->
<div class="w-full h-auto px-4 sm:px-10 py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center border border-gray-300">
  <h1 class="text-lg sm:text-xl font-bold mb-2 sm:mb-0">Kategori</h1>
  <ul class="flex gap-2 sm:gap-4 items-center">
    <li><a class="hover:text-gray-500" href="index.php">All</a></li>
    <li><a class="hover:text-gray-500" href="index.php">Makanan</a></li>
    <li><a class="hover:text-gray-500" href="index.php">Minuman</a></li>
    
    <li class="relative group">
      <div class="relative inline-block w-[100px] sm:w-[150px]">
        <button id="dropdownButton" class="w-full px-2 sm:px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-sm">
          Pilih Kategori
        </button>
        <div id="dropdownMenu" class="hidden absolute mt-1 w-full bg-white shadow-lg rounded-md z-10 group-hover:block">
          <ul class="py-1 text-gray-700">
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Sepatu</a></li>
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Tas</a></li>
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Baju</a></li>
          </ul>
        </div>
      </div>
    </li>
  </ul>
</div>

<!-- buat kan card produk -->
<div class="w-full flex flex-wrap justify-center items-center gap-4 mt-4">
    <?php
    if ($queryproduk && mysqli_num_rows($queryproduk) > 0) {
        while ($rowproduk = mysqli_fetch_assoc($queryproduk)) {
            ?>
    <div
      class="bg-white rounded-lg shadow-lg w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 h-auto border border-gray-300 p-4 flex flex-col justify-between items-center">
      <div class="w-full flex justify-center mb-4">
        <a
          href="detailproduk.php?id=<?= $rowproduk['id']; ?>">
          <img
            src="produk/<?= $rowproduk['produk_image']; ?>"
            alt="<?= $rowproduk['produk_nama']; ?>"
            class="object-cover h-48 w-full sm:h-60 md:h-64 lg:h-72" />
        </a>
      </div>
      <div class="w-full text-center">
        <p class="text-lg font-bold tracking-wide uppercase mb-2">
          <?= $rowproduk['produk_nama']; ?>
        </p>
        <p class="text-lg text-red-500">Rp.
          <?= number_format($rowproduk['produk_harga'], 0, ',', '.'); ?>
        </p>
      </div>
    </div>
    <?php
        }
    } else {
        echo "<p class='text-center w-full'>Tidak ada produk yang ditemukan.</p>";
    }
?>
  </div>


  <div class="flex justify-center my-6">
    <?php if ($page > 1): ?>
    <a href="?page=<?= $page - 1 ?>"
      class="mx-2 px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Previous</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
    <a href="?page=<?= $i ?>"
      class="mx-2 px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 <?= ($i == $page) ? 'bg-gray-400' : '' ?>"><?= $i ?></a>
    <?php endfor; ?>

    <?php if ($page < $total_pages): ?>
    <a href="?page=<?= $page + 1 ?>"
      class="mx-2 px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Next</a>
    <?php endif; ?>
  </div>

<!-- Buat Kan Saya Footer --> 
  <footer class="w-full bg-gray-800">
    <div class="container mx-auto px-6 py-8">
      <div class="flex flex-col lg:flex-row justify-between items-center text-white">
        <div class="mb-6 lg:mb-0 lg:w-1/3">
          <a href="#" class="text-xl lg:text-3xl font-bold">Toko BukaWaroeng</a>
          <p class="mt-4 text-gray-300 text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla itaque
            unde enim iste pariatur.</p>
        </div>
        <div class="flex flex-col lg:flex-col items-center lg:items-start">
          <ul class="flex text-[14px]  lg:flex-row gap-2 lg:gap-10 mb-4 lg:mb-0">
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="index.php"> Home </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="about.php"> About </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="category.php"> Category </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="product.php"> Product </a>
          </li>
          </ul>
          <p class="text-gray-400">&copy; 2022. All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    menuToggle.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</body>
</html>