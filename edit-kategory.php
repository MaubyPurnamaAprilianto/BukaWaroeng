<?php
session_start();
include 'koneksi.php';
if ($_SESSION["login"] !== true) {
    echo "<script>window.location='login.php'</script>";
    exit;
}

$id = $_GET['id'];
$kategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id = '$id'");
if(mysqli_num_rows($kategori) == 0){
  echo "<script>window.location='data_kategori.php'</script>";
}
$data = mysqli_fetch_assoc($kategori);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bukawarung</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="index.css">
</head>

<body class="bg-gray-100">

  <!-- content -->
  <div class="flex justify-center items-center my-8">
    <div class="w-[80%] bg-white p-8 rounded shadow">
      <h3 class="text-2xl font-semibold mb-4">Edit Data Kategori</h3>
      <div>
        <form action="logikaeditkategori.php" method="POST" enctype="multipart/form-data">
          <div class="mb-4">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            <input type="text" name="kategori" class="text-[14px] border border-gray-300 px-3 py-2 w-full rounded mb-4" placeholder="Nama Kategori" value="<?= $data['kategori_name'] ?>" required>
          </div>
          <div>
            <input type="submit" name="submit" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
          $kategori = $_POST['kategori'];

          $query = mysqli_query($conn, "UPDATE kategori SET kategori_name = '$kategori' WHERE id = '$id'");

          if ($query) {
            echo "<script>alert('Edit Data Berhasil');window.location='data_kategori.php';</script>";
          } else {
            echo "<script>alert('Edit Data Gagal');window.location='data_kategori.php';</script>";
          }
        }
        ?>
      </div>
    </div>
  </div>

</body>

</html>
