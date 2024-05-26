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
      echo "<script>alert('Ubah Profil Berhasil');window.location='profil.php'</script>";
  } else {
      echo 'gagal'.mysqli_error($conn);
  }
}


if (isset($_POST['ubah_password'])) {
  $pass1 = $_POST['pass1'];
  $pass2 = $_POST['pass2'];
  if ($pass1 != $pass2) {
      echo "<script>alert('Password Tidak Sama');window.location='profil.php'</script>";
  } else {
      $update = mysqli_query($conn, "UPDATE user SET password = '".MD5($pass1)."' WHERE id = '$_SESSION[id]'");
      if ($update) {
          echo "<script>alert('Ubah Password Berhasil');window.location='profil.php'</script>";
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
            <a class="text-gray-500 transition hover:text-gray-500/75 bg-gray-900 px-4 py-2 rounded-lg " id="active"
              href="admin.php"> Dashboard </a>
          </li>
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="profiluser.php"> Profil </a>
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
          <input type="text" name="search" placeholder="Cari Produk"
            class="bg-gray-700 text-white px-4 py-3 h-8 rounded-md text-xs focus:shadow-outline">
          <button class="bg-blue-600 h1 px-2 hover:text-white hover:bg-blue-700 rounded-md">
            <i class="fa-solid fa-magnifying-glass text-white"></i>
          </button>
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
          <a href="#" class="text-xl lg:text-3xl font-bold">Toko BukaWaroeng</a>
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