<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

if ($_SESSION["login"] !== true) {
    echo "<script>window.location='login.php'</script>";
    exit;
}

// Fetch user data
$query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$_SESSION[id]'");
$row = mysqli_fetch_array($query);

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
</head>

<body>
  <header class="bg-gray-800 fixed w-full z-10">
    <div class="mx-auto flex h-16 max-w-screen-xl items-center gap-8 px-4 sm:px-6 lg:px-8">
      <a class="block text-teal-600" href="#">
        <span class="sr-only">Home</span>
        <svg class="h-8" viewBox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M0.41 10.3847C1.14777 7.4194 2.85643 4.7861 5.2639 2.90424C7.6714 1.02234 10.6393 0 13.695 0C16.7507 0 19.7186 1.02234 22.1261 2.90424C24.5336 4.7861 26.2422 7.4194 26.98 10.3847H25.78C23.7557 10.3549 21.7729 10.9599 20.11 12.1147C20.014 12.1842 19.9138 12.2477 19.81 12.3047H19.67C19.5662 12.2477 19.466 12.1842 19.37 12.1147C17.6924 10.9866 15.7166 10.3841 13.695 10.3841C11.6734 10.3841 9.6976 10.9866 8.02 12.1147C7.924 12.1842 7.8238 12.2477 7.72 12.3047H7.58C7.4762 12.2477 7.376 12.1842 7.28 12.1147C5.6171 10.9599 3.6343 10.3549 1.61 10.3847H0.41ZM23.62 16.6547C24.236 16.175 24.9995 15.924 25.78 15.9447H27.39V12.7347H25.78C24.4052 12.7181 23.0619 13.146 21.95 13.9547C21.3243 14.416 20.5674 14.6649 19.79 14.6649C19.0126 14.6649 18.2557 14.416 17.63 13.9547C16.4899 13.1611 15.1341 12.7356 13.745 12.7356C12.3559 12.7356 11.0001 13.1611 9.86 13.9547C9.2343 14.416 8.4774 14.6649 7.7 14.6649C6.9226 14.6649 6.1657 14.416 5.54 13.9547C4.4144 13.1356 3.0518 12.7072 1.66 12.7347H0V15.9447H1.61C2.39051 15.924 3.154 16.175 3.77 16.6547C4.908 17.4489 6.2623 17.8747 7.65 17.8747C9.0377 17.8747 10.392 17.4489 11.53 16.6547C12.1468 16.1765 12.9097 15.9257 13.69 15.9447C14.4708 15.9223 15.2348 16.1735 15.85 16.6547C16.9901 17.4484 18.3459 17.8738 19.735 17.8738C21.1241 17.8738 22.4799 17.4484 23.62 16.6547ZM23.62 22.3947C24.236 21.915 24.9995 21.664 25.78 21.6847H27.39V18.4747H25.78C24.4052 18.4581 23.0619 18.886 21.95 19.6947C21.3243 20.156 20.5674 20.4049 19.79 20.4049C19.0126 20.4049 18.2557 20.156 17.63 19.6947C16.4899 18.9011 15.1341 18.4757 13.745 18.4757C12.3559 18.4757 11.0001 18.9011 9.86 19.6947C9.2343 20.156 8.4774 20.4049 7.7 20.4049C6.9226 20.4049 6.1657 20.156 5.54 19.6947C4.4144 18.8757 3.0518 18.4472 1.66 18.4747H0V21.6847H1.61C2.39051 21.664 3.154 21.915 3.77 22.3947C4.908 23.1889 6.2623 23.6147 7.65 23.6147C9.0377 23.6147 10.392 23.1889 11.53 22.3947C12.1468 21.9165 12.9097 21.6657 13.69 21.6847C14.4708 21.6623 15.2348 21.9135 15.85 22.3947C16.9901 23.1884 18.3459 23.6138 19.735 23.6138C21.1241 23.6138 22.4799 23.1884 23.62 22.3947Z"
            fill="currentColor" />
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
              <a class="text-gray-500 transition hover:text-gray-500/75" href="category.php"> Product </a>
            </li>
            <li>
              <a class="text-gray-500 transition hover:text-gray-500/75" href="profiluser.php"> Profil </a>
            </li>
          </ul>
        </nav>

        <div class="flex items-center gap-4">
          <div >
            <form method="GET" class="flex justify-center gap-2">
              <input type="text" name="search" placeholder="Cari Produk"
                class="bg-gray-700 text-white px-4 py-3 h-8 rounded-md text-xs focus:shadow-outline">
              <button class="bg-blue-600 h1 px-2 hover:text-white hover:bg-blue-700 rounded-md">
                <i class="fa-solid fa-magnifying-glass text-white"></i>
              </button>
            </form>
          </div>
          <div class="sm:flex sm:gap-4">
            <a class="block rounded-md bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700"
              href="logikalogout.php">
              Logout
            </a>
            <!-- <a class="hidden rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-blue-600 transition hover:text-blue-600/75 sm:block" href="registar.php">
            Register
          </a> -->
          </div>

          <button class="block rounded bg-gray-100 p-2.5 text-gray-600 transition hover:text-gray-600/75 md:hidden">
            <span class="sr-only">Toggle menu</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </header>

  <!-- <nav class="w-full h-16 bg-gray-800 px-6 flex justify-between items-center text-white fixed z-10">
    <div>
      <a class="text-3xl font-bold" href="index.php">Toko BukaWaroeng</a>
    </div>
    <div>
      <ul class="flex gap-4">
        <li><a class="hover:text-gray-500" href="admin.php">Home</a></li>
        <li><a class="hover:text-gray-500" href="about.php">About</a></li>
        <li><a class="hover:text-gray-500" href="produk.php">Product</a></li>
        <li><a class="hover:text-gray-500" href="profiluser.php">Profil</a></li>
        <li><a href="logikalogout.php" class="btn px-4 py-2 hover:text-white rounded-lg">Logout</a></li>
      </ul>
    </div>
  </nav> -->

  <div class="w-full h-screen flex justify-center items-center px-[10%] bg-gray-100">
    <div
      class="w-full h-[55%] flex justify-center items-center flex-col bg-white rounded-lg p-[10%] text-center border border-gray-500">
      <h3 class="text-2xl font-bold mb-4 text-blue-700">Selamat Datang
        <?= $row['name']; ?> Di Toko BukaWaroeng
      </h3>
      <p>Aplikasi Katalog Produk – Jadikan tokomu selalu update dalam mengelola pesanan dan persedian produk dengan
        menggunakan BukaWaroeng.</p>
    </div>
  </div>

  <!-- <div class="w-full h-[13vh] flex justify-center border-b border-gray-300 py-4 gap-2 mt-6">
    <form method="GET" class="w-full flex justify-center items-center gap-2">
      <input type="text" name="search" placeholder="Cari Produk" class="w-[50%] border border-gray-500 p-2 rounded-lg">
      <button type="submit" class="btn px-4 py-1 hover:text-white hover:bg-gray-500 rounded-lg">Search</button>
    </form>
  </div> -->


  <!-- buat kan saya kategory -->
  <div class="w-full h-16 px-10 flex justify-between items-center">
    <h1 class="text-xl font-bold">Kategori</h1>
    <ul class="flex gap-4 items-center">
      <li><a class="hover:text-gray-500" href="index.php">All</a></li>
      <li><a class="hover:text-gray-500" href="index.php">Makanan</a></li>
      <li><a class="hover:text-gray-500" href="index.php">Minuman</a></li>
      <li class="relative group">
        <div class="relative inline-block w-[150px]">
          <button id="dropdownButton"
            class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            Pilih Kategori
          </button>
          <div id="dropdownMenu" class="hidden absolute mt-1 w-full bg-white shadow-lg rounded-md z-10">
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

  <div class="w-full flex flex-wrap justify-center items-center gap-4 mt-4">
    <?php
        if ($queryproduk && mysqli_num_rows($queryproduk) > 0) {
            while ($rowproduk = mysqli_fetch_assoc($queryproduk)) {
                ?>
    <div class="bg-white rounded-lg shadow-lg w-[30%] h-[70vh] p-4 flex justify-center items-center flex-col">
      <div class="w-full flex justify-center h-[70%]">
        <a
          href="detailproduk.php?id=<?= $rowproduk['id']; ?>">
          <img
            src="produk/<?= $rowproduk['produk_image']; ?>"
            alt="<?= $rowproduk['produk_nama']; ?>"
            width="250px">
        </a>
      </div>
      <div class="w-full h-[30%]">
        <p class="text-2xl font-bold tracking-[0.1em] uppercase">
          <?= $rowproduk['produk_nama']; ?>
        </p>
        <p class="text-xl text-right text-red-500">Rp.
          <?= number_format($rowproduk['produk_harga'], 0, ',', '.'); ?>
        </p>
      </div>
    </div>
    <?php
            }
        } else {
            echo "<p>Tidak ada produk yang ditemukan.</p>";
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
  <footer class="w-full h-64 bg-gray-800">
    <div class="w-full h-full px-10 flex justify-between items-center text-white">
      <div class="w-[40%]">
        <a href="#" class="text-3xl font-bold">Toko BukaWaroeng</a>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
  <script src="js/script.js"></script>
</body>

</html>