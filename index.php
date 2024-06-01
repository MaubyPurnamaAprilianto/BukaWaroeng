<?php
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");
session_start();


// Pagination variables
$limit = 6; // Number of products per page
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
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="index.css">
  <style>
    .hidden {
      display: none;
    }
  </style>
</head>

<body>
  <header class="bg-gray-800 fixed  w-full z-10">
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
          <!-- <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="index.php"> Dashboard </a>
          </li> -->
          <!-- <li> 
            <a class="text-gray-500 transition hover:text-gray-500/75" href="data_kategori.php"> Data Kategori </a>
          </li> -->
          <!-- 
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
          <input type="text" name="search" placeholder="Cari Produk"
            class="bg-gray-700 text-white px-4 py-3 h-8 rounded-md text-xs focus:shadow-outline">
          <button class="bg-blue-600 h1 px-2 hover:text-white hover:bg-blue-700 rounded-md">
            <i class="fa-solid fa-magnifying-glass text-white"></i>
          </button>
        </div>
        <div class="sm:flex sm:gap-4">
          <a class="block rounded-md bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700"
            href="login.php">
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
          <!-- <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="index.php"> Dashboard </a>
          </li> -->
          <!-- <li> 
            <a class="text-white transition hover:text-gray-500/75" href="data_kategori.php"> Data Kategori </a>
          </li> -->
          <!-- 
          <li class="border-b border-gray-100 w-full pb-2">
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

  </header>

  <!-- banner -->
  <section class="bg-gray-50">
    <div class="mx-auto max-w-screen-xl px-4 py-32 lg:flex lg:h-screen lg:items-center">
      <div class="mx-auto max-w-xl text-center">
        <h1
          class="text-xl font-extrabold sm:text-3xl flex flex-col text-left  sm:text-center  justify-center sm:flex-row">
          Hello ! Welcome to
          <span class="font-extrabold text-blue-700 sm:block text-right sm:text-center ml-2">BUKAWAROENG. </span>
        </h1>

        <p class="mt-4 sm:text-[0.9rem] sm:leading-relaxed">
          Aplikasi Katalog Produk – Jadikan tokomu selalu update dalam mengelola pesanan dan persedian produk dengan
          menggunakan BukaWaroeng.
        </p>

        <div class="mt-8 flex flex-wrap justify-center gap-4">
          <!-- <a
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
        </a> -->
        </div>
      </div>
    </div>
  </section>

  <!-- about -->
  <section>
    <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
      <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-16">
        <div class="relative h-64 overflow-hidden rounded-lg sm:h-80 lg:order-last lg:h-full">
          <img alt="A scenic view"
            src="https://images.unsplash.com/photo-1527529482837-4698179dc6ce?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
            class="absolute inset-0 h-full w-full object-cover" />
        </div>

        <div class="lg:py-24">
          <h2 class="text-3xl font-bold sm:text-4xl">Tentang Kami </h2>

          <p class="mt-4 text-gray-600">
            Kami adalah platform terdepan yang menyediakan berbagai produk berkualitas tinggi dari berbagai kategori.
            Dari smartphone terbaru hingga gadget inovatif, kami memiliki semua yang Anda butuhkan untuk memenuhi gaya
            hidup modern Anda.
          </p>

          <a href="#products"
            class="mt-8 inline-block rounded bg-indigo-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-yellow-400">
            Lihat Produk
          </a>
        </div>
      </div>
    </div>
  </section>



  <!-- buat kan saya kategory -->
  <div
    class="w-full h-auto px-4 sm:px-10 py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center border border-gray-300">
    <h1 class="text-lg sm:text-xl font-bold mb-2 sm:mb-0">Kategori</h1>
    <ul class="flex gap-2 sm:gap-4 items-center">
      <li><a class="hover:text-gray-500 cursor-pointer" onclick="filterProducts('all')">All</a></li>
      <li class="relative group">
        <div class="relative inline-block w-[100px] sm:w-[150px]">
          <button id="dropdownButton"
            class="w-full px-2 sm:px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-sm">
            Pilih Kategori
          </button>
          <div id="dropdownMenu"
            class="hidden absolute mt-1 w-full bg-white shadow-lg rounded-md z-10 group-hover:block">
            <ul class="py-1 text-gray-700">
              <?php
    $query = mysqli_query($conn, "SELECT * FROM kategori");
while ($row = mysqli_fetch_assoc($query)) {
    ?>
              <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 cursor-pointer"
                  onclick="filterProducts('<?= $row['id']; ?>')"><?= $row['kategori_name']; ?></a>
              </li>
              <?php
}
?>
            </ul>
          </div>
        </div>
      </li>
    </ul>
  </div>

  <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-4 mt-4 px-10"
    id="products">
    <?php
if ($queryproduk && mysqli_num_rows($queryproduk) > 0) {
    while ($rowproduk = mysqli_fetch_assoc($queryproduk)) {
        ?>
    <div class="bg-white rounded-lg shadow-lg border border-gray-300 p-4 flex flex-col justify-between items-center"
      data-category="<?= $rowproduk['kategori_id']; ?>">
      <!-- Added data-category attribute -->
      <div class="w-full flex justify-center mb-4">
        <a
          href="detailproduk.php?id=<?= $rowproduk['id']; ?>">
          <img
            src="produk/<?= $rowproduk['produk_image']; ?>"
            alt="<?= $rowproduk['produk_nama']; ?>"
            class="object-cover h-48 w-full sm:h-60 md:h-64 lg:h-72" />
        </a>
      </div>
      <div class="w-full">
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
          <a class="block text-teal-600 mx-auto md:mx-0" href="#">
            <h1 class="text-[15px] sm:text-2xl font-bold text-white">BUKA<span class="text-blue-600">WAROENG</span></h1>
          </a>
          <p class="mt-4 text-gray-300 text-sm">Aplikasi Katalog Produk – Jadikan tokomu selalu update dalam mengelola
            pesanan dan persedian produk dengan menggunakan BukaWaroeng.</p>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
  <script src="js/script.js"></script>
  <script>
    function filterProducts(categoryId) {
      const products = document.querySelectorAll('[data-category]');
      products.forEach(product => {
        if (categoryId === 'all' || product.getAttribute('data-category') === categoryId) {
          product.style.display = 'block';
        } else {
          product.style.display = 'none';
        }
      });
    }
  </script>
  <script>
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    menuToggle.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</body>

</html>