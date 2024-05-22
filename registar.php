<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
  <link rel="stylesheet" href="index.css">
</head>
<body class="p-5 bg-black">
  <div class="container d-flex justify-content-center flex-column w-50 border border-white text-light p-5  shadow rounded" style="height: 500px;">
    <h1 class="text-center text-light mb-5">Login</h1>
    <form action="logikaregistar.php" method="post">
      <div class="d-flex gap-3">
        <div class="mb-3">
          <label for="name" class="form-label">name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Name" required>
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username" required>
        </div>
      </div>
      <div class="d-flex gap-3">
        <div class="mb-3">
          <label for="email" class="form-label">email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password" required>
        </div>
      </div>
      <button type="submit" class="btn btn-outline-primary">Login</button>
    </form>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>