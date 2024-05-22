<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

if ($_SESSION["login"] !== true) {
  echo "<script>window.location='login.php'</script>";
  exit;
}

$query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$_SESSION[id]'");
$data = mysqli_fetch_array($query);

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
    <div class="text-3xl font-bold">
      <h1>Katalog</h1>
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
      <h3 class="text-2xl font-bold mb-4">Porfil</h3>
      <div class="text-xl border border-gray-500 rounded-lg p-4">
        <form action="" method="post">
          <input type="text" name="name" placeholder="Masukan Nama Lengkap" class="text-[14px] border border-gray-500 w-full h-12 rounded px-4 mb-4" value="<?= $data['name'] ?>"  required>
          <input type="text" name="username" placeholder="Masuka Username" class="text-[14px] border border-gray-500 w-full h-12 rounded px-4 mb-4" value="<?= $data['username'] ?>"  required>
          <input type="text" name="hp" placeholder="Masukan Nomor Handphone" class="text-[14px] border border-gray-500 w-full h-12 rounded px-4 mb-4" value="<?= $data['nomer_hp'] ?>"  required>
          <input type="email" name="email" placeholder="Masuka Email" class="text-[14px] border border-gray-500 w-full h-12 rounded px-4 mb-4" value="<?= $data['email'] ?>" required>
          <input type="text" name="alamat" placeholder="Masuka Alamat" class="text-[14px] border border-gray-500 w-full h-12 rounded px-4 mb-4" value="<?= $data['alamat'] ?>" required>
          <input type="submit" name="submit" value="Ubah Profil" class="btn px-4 py-2 hover:bg-gray-500 hover:text-white rounded-lg">
        </form>
        <?php
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
        ?>
      </div>
      <!-- ubah password -->
      <h3 class="text-2xl font-bold my-4">Ubah Password</h3>
      <div class="text-xl border border-gray-500 rounded-lg p-4">
        <form action="" method="post">
          <input type="password" name="pass1" placeholder="Masukan Password Baru" class="text-[14px] border border-gray-500 w-full h-12 rounded px-4 mb-4" required>
          <input type="password" name="pass2" placeholder="Confirmasi Password" class="text-[14px] border border-gray-500 w-full h-12 rounded px-4 mb-4" required>
          <input type="submit" name="ubah_password" value="Ubah Password" class="btn px-4 py-2 hover:bg-gray-500 hover:text-white rounded-lg">
        </form>
        <?php
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
      </div>
    </div>
  </div>
</body>
</html>