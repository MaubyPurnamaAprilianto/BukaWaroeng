<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="index.css">
</head>
<body>
<div class="min-h-screen flex justify-center items-center bg-gray-100">
  <div class="w-full max-w-lg p-8 bg-white text-gray-900 rounded-lg shadow-lg">
    <h1 class="text-center text-4xl font-bold mb-6">Register</h1>
    <form action="logikaregistar.php" method="post" class="space-y-6">
      <div class="flex flex-col sm:flex-row gap-3">
        <div class="w-full">
          <label for="name" class="block text-sm font-medium leading-6 text-gray-700">Name</label>
          <input type="text" id="name" name="name" placeholder="Masukan Name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-100 text-gray-900" required>
        </div>
        <div class="w-full">
          <label for="username" class="block text-sm font-medium leading-6 text-gray-700">Username</label>
          <input type="text" id="username" name="username" placeholder="Masukan Username" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-100 text-gray-900" required>
        </div>
      </div>
      <div class="flex flex-col sm:flex-row gap-3">
        <div class="w-full">
          <label for="email" class="block text-sm font-medium leading-6 text-gray-700">Email</label>
          <input type="email" id="email" name="email" placeholder="Masukan Email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-100 text-gray-900" required>
        </div>
        <div class="w-full">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-700">Password</label>
          <input type="password" id="password" name="password" placeholder="Masukan Password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-100 text-gray-900" required>
        </div>
      </div>
      <p class="text-sm text-gray-500">Sudah punya akun? <a href="login.php" class="text-indigo-600 hover:text-indigo-500">Login</a></p>
      <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Register</button>
    </form>
  </div>
</div>



</body>
</html>