<?php
session_start();
include 'koneksi.php';
if ($_SESSION["login"] !== true) {
    echo "<script>window.location='login.php'</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="index.css">
  <style>
    .hidden {
      display: none;
    }
  </style>
</head>

<body>
  <header class="bg-gray-800 w-full z-10">
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
            <a class="text-gray-500 transition hover:text-gray-500/75 py-3 px-2" href="dashboard.php"> Dashboard </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75 py-3 px-2" href="data_kategori.php"> Data Kategori </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75 py-3 px-2" href="data_produk.php"> Data Produk </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75 py-3 px-2" href="data_user.php"> Data User </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75 py-3 px-2" href="profil.php"> Profil </a>
          </li>
        </ul>
      </div>
      <div class=" md:flex items-center gap-4">
        <a class="rounded-md bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700"
          href="logikalogout.php">
          Logout
        </a>
      </div>
    </div>
    <div id="mobile-menu" class="md:hidden hidden">
      <nav aria-label="Mobile" class="px-4 py-2">
        <ul class="flex flex-col gap-2 text-sm">
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="dashboard.php"> Dashboard </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="data_kategori.php"> Data Kategori </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="data_produk.php"> Data Produk </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="data_user.php"> Data User </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="profil.php"> Profil </a>
          </li>
          <!-- <li>
                      <form method="GET" class="flex items-center gap-2">
                          <input type="text" name="search" placeholder="Cari Produk" class="bg-gray-700 text-white px-4 py-2 rounded-md text-sm focus:shadow-outline">
                          <button class="bg-blue-600 px-2 py-2 rounded-md hover:bg-blue-700">
                              <i class="fa-solid fa-magnifying-glass text-white"></i>
                          </button>
                      </form>
                  </li> -->
        </ul>
      </nav>
    </div>
    <nav aria-label="Global" class="hidden md:block">
      <ul class="hidden md flex items-center gap-6 text-sm">
        <li>
          <a class="text-gray-500 transition hover:text-gray-500/75" href="dashboard.php"> Dashboard </a>
        </li>
        <li>
          <a class="text-gray-500 transition hover:text-gray-500/75" href="data_kategori.php"> Data Kategori </a>
        </li>
        <li>
          <a class="text-gray-500 transition hover:text-gray-500/75" href="data_produk.php"> Data Produk </a>
        </li>
        <li>
          <a class="text-gray-500 transition hover:text-gray-500/75" href="data_user.php"> Data User </a>
        </li>
        <li>
          <a class="text-gray-500 transition hover:text-gray-500/75" href="profil.php"> Profil </a>
        </li>
        <!-- <li class="hidden md:flex items-center">
                  <form method="GET" class="flex items-center gap-2">
                      <input type="text" name="search" placeholder="Cari Produk" class="bg-gray-700 text-white px-4 py-2 rounded-md text-sm focus:shadow-outline">
                      <button class="bg-blue-600 px-2 py-2 rounded-md hover:bg-blue-700">
                          <i class="fa-solid fa-magnifying-glass text-white"></i>
                      </button>
                  </form>
              </li> -->
      </ul>
    </nav>
  </header>

  <!-- buat kan saya table produk dengan column no nama produk , harga,deksripsi,image -->
  <div class="w-full min-h-screen flex flex-col p-10">
    <h1 class="text-3xl font-bold mb-6">Data Produk</h1>
    <div class="mb-4">
      <a href="tambah_produk.php" class="bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 rounded-lg">Tambah</a>
    </div>
    <div class="overflow-x-auto w-full">
      <table class="table-auto w-full mt-6 border border-gray-300" cellspacing="0" cellpadding="10">
        <thead>
          <tr>
            <th class="border border-gray-300 px-4 py-2">No</th>
            <th class="border border-gray-300 px-4 py-2">Nama Kategori</th>
            <th class="border border-gray-300 px-4 py-2">Nama Produk</th>
            <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
            <th class="border border-gray-300 px-4 py-2">Harga</th>
            <th class="border border-gray-300 px-4 py-2">Gambar</th>
            <th class="border border-gray-300 px-4 py-2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
        $no = 1;
          $conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");
          $query = mysqli_query($conn, "SELECT produk.*, kategori.kategori_name FROM produk LEFT JOIN kategori ON produk.kategori_id = kategori.id ORDER BY produk.id DESC");

          while($data = mysqli_fetch_array($query)) {
              ?>
          <tr>
            <td class="border border-gray-300 px-4 py-2"><?= $no++ ?>

            </td>
            <td class="border border-gray-300 px-4 py-2">
              <?= $data['kategori_name'] ?>
            </td>
            <td class="border border-gray-300 px-4 py-2">
              <?= $data['produk_nama'] ?>
            </td>
            <td class="border border-gray-300 px-4 py-2">
              <?= $data['produk_deksripsi'] ?>
            </td>
            <td class="border border-gray-300 px-4 py-2">Rp.
              <?= number_format($data['produk_harga']) ?>
            </td>
            <td class="border border-gray-300 px-4 py-2 flex justify-center">
              <a href="produk/<?php echo $data['produk_image'] ?>"
                target="_blank">
                <img
                  src="produk/<?php echo $data['produk_image'] ?>"
                  class="w-12 h-12 object-cover rounded" alt="Gambar Produk">
              </a>
            </td>
            <td class="border border-gray-300 px-4 py-2">
              <div class="flex justify-center">
                <a href="edit_produk.php?id=<?= $data['id'] ?>"
                  class="bg-green-500 px-4 py-2 text-white hover:bg-green-600 rounded-lg mr-2">Edit</a>
                <a href="delete_produk.php?id=<?= $data['id'] ?> "
                  onclick="return confirm('Yakin ingin hapus ?')"
                  class="bg-red-500 px-4 py-2 text-white hover:bg-red-700 rounded-lg">Delete</a>
              </div>
            </td>
          </tr>
          <tr class="hidden">
            <td colspan="6" class="border border-gray-300 px-4 py-2">
              <b>Kategori:</b>
              <?= $data['kategori_name'] ?><br>
              <b>Deskripsi:</b>
              <?= $data['produk_deksripsi'] ?><br>
              <b>Harga:</b> Rp.
              <?= number_format($data['produk_harga']) ?><br>
              <b>Gambar:</b> <a
                href="produk/<?php echo $data['produk_image'] ?>"
                target="_blank">Link</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>


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
              <a class="text-gray-500 transition hover:text-gray-500/75 " href="dashboard.php"> Dashboard </a>
            </li>
            <li>
              <a class="text-gray-500 transition hover:text-gray-500/75" href="data_kategori.php"> Data Kategori </a>
            </li>
            <li>
              <a class="text-gray-500 transition hover:text-gray-500/75" href="data_produk.php"> Data Produk </a>
            </li>
            <li>
              <a class="text-gray-500 transition hover:text-gray-500/75" href="data_user.php"> Data User </a>
            </li>
            <li>
              <a class="text-gray-500 transition hover:text-gray-500/75" href="profil.php"> Profil </a>
            </li>
          </ul>
          <p class="text-gray-400">&copy; 2022. All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>

  <script>
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    menuToggle.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</body>

</html>