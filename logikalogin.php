<?php

session_start();

$conn = mysqli_connect("localhost", "root", "", "db_katalog_produk");

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $query);


if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['login'] = true;
    $_SESSION['username'] = $row['username'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['level'] = $row['level'];

    if ($row['level'] == 1) {
      header("Location: dashboard.php");
    } elseif ($row['level'] == 2) {
      header("Location: admin.php");
    }
    exit;
} else {
    echo '<script>alert("Username atau password salah!");window.location.href="login.php";</script>';
}

$conn->close();

