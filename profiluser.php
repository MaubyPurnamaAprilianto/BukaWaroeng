<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

if ($_SESSION["login"] !== true) {
    echo "<script>window.location='login.php'</script>";
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$_SESSION[id]'");
$data = mysqli_fetch_array($query);


if (isset($_POST['submit'])) {

    $name = ucwords($_POST['name']);
    $username = $_POST['username'];
    $hp = $_POST['hp'];
    $email = $_POST['email'];
    $alamat = ucwords($_POST['alamat']);
    $update = mysqli_query($conn, "UPDATE user SET name = '$name', username = '$username', nomer_hp = '$hp', email = '$email', alamat = '$alamat' WHERE id = '$_SESSION[id]'");
    if ($update) {
        echo "<script>alert('Ubah Profil Berhasil');window.location='profiluser.php'</script>";
    } else {
        echo 'gagal'.mysqli_error($conn);
    }
}


if (isset($_POST['ubah_password'])) {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    if ($pass1 != $pass2) {
        echo "<script>alert('Password Tidak Sama');window.location='profiluser.php'</script>";
    } else {
        $update = mysqli_query($conn, "UPDATE user SET password = '".MD5($pass1)."' WHERE id = '$_SESSION[id]'");
        if ($update) {
            echo "<script>alert('Ubah Password Berhasil');window.location='profiluser.php'</script>";
        } else {
            echo 'gagal'.mysqli_error($conn);
        }
    }
}
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
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75 px-4 py-3" id="active"
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

  <!-- content -->
  <div class="w-full min-h-screen flex justify-center px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-lg rounded-lg p-8">
      <h3 class="text-2xl font-bold mb-4 text-center">Profil</h3>
      <div class="text-xl border border-gray-500 rounded-lg p-4">
        <form action="" method="post">
          <input type="text" name="name" placeholder="Masukan Nama Lengkap"
            class="text-[14px] border border-gray-500 w-full h-12 rounded px-4 mb-4"
            value="<?= $data['name'] ?>"
            required>
          <input type="text" name="username" placeholder="Masuka Username"
            class="text-[14px] border border-gray-500 w-full h-12 rounded px-4 mb-4"
            value="<?= $data['username'] ?>"
            required>
          <input type="text" name="hp" placeholder="Masukan Nomor Handphone"
            class="text-[14px] border border-gray-500 w-full h-12 rounded px-4 mb-4"
            value="<?= $data['nomer_hp'] ?>"
            required>
          <input type="email" name="email" placeholder="Masuka Email"
            class="text-[14px] border border-gray-500 w-full h-12 rounded px-4 mb-4"
            value="<?= $data['email'] ?>"
            required>
          <input type="text" name="alamat" placeholder="Masuka Alamat"
            class="text-[14px] border border-gray-500 w-full h-12 rounded px-4 mb-4"
            value="<?= $data['alamat'] ?>"
            required>
          <input type="submit" name="submit" value="Ubah Profil"
            class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-600 hover:text-white rounded-lg w-full">
        </form>
      </div>

      <h3 class="text-2xl font-bold my-4 text-center">Ubah Password</h3>
      <div class="text-xl border border-gray-500 rounded-lg p-4">
        <form action="" method="post">
          <input type="password" name="pass1" placeholder="Masukan Password Baru"
            class="text-[14px] border border-gray-500 w-full h-12 rounded px-4 mb-4" required>
          <input type="password" name="pass2" placeholder="Confirmasi Password"
            class="text-[14px] border border-gray-500 w-full h-12 rounded px-4 mb-4" required>
          <input type="submit" name="ubah_password" value="Ubah Password"
            class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-600 hover:text-white rounded-lg w-full">
        </form>
      </div>
    </div>
  </div>

  <!-- Buat Kan Saya Footer -->
  <footer class="w-full bg-gray-800">
    <div class="container mx-auto px-6 py-8">
      <div class="flex flex-col lg:flex-row justify-between items-center text-white">
        <div class="mb-6 lg:mb-0 lg:w-1/3">
          <a class="block text-teal-600 mx-auto md:mx-0" href="#">
            <h1 class="text-[15px] sm:text-2xl font-bold text-white">BUKA<span class="text-blue-600">WAROENG</span></h1>
          </a>
          <p class="mt-4 text-gray-300 text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla itaque
            unde enim iste pariatur.</p>
        </div>
        <div class="flex flex-col lg:flex-col items-center lg:items-start">
          <ul class="flex text-[14px]  lg:flex-row gap-2 lg:gap-10 mb-4 lg:mb-0">
            <li>
              <a class="text-gray-500 transition hover:text-gray-500/75" href="admin.php"> Dashboard </a>
            </li>
            <li>
              <a class="text-gray-500 transition hover:text-gray-500/75" href="profiluser.php"> Profil </a>
              <!-- </li>
            <li>
              <a class="text-gray-500 transition hover:text-gray-500/75" href="category.php"> Category </a>
            </li>
            <li>
              <a class="text-gray-500 transition hover:text-gray-500/75" href="product.php"> Product </a>
            </li> -->
          </ul>
          <p class="text-gray-400">&copy; 2022. All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>

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