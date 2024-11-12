<?php
require 'koneksi.php';

if (isset($_POST["registered"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>alert('Username ditambahkan!'); 
                document.location.href = 'index.php';
            </script>";
    } else {
        echo mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-white p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-extrabold text-gray-800 text-center mb-6">Halaman Registrasi</h1>

        <form action="" method="post" class="space-y-6">
            <div class="flex flex-col">
                <label for="username" class="text-gray-700 font-semibold mb-1">Username:</label>
                <input type="text" name="username" id="username"
                    class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition duration-300"
                    placeholder="Enter your username">
            </div>
            <div class="flex flex-col">
                <label for="password" class="text-gray-700 font-semibold mb-1">Password:</label>
                <input type="password" name="password" id="password"
                    class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition duration-300"
                    placeholder="Enter your password">
            </div>
            <div class="flex flex-col">
                <label for="password2" class="text-gray-700 font-semibold mb-1">Konfirmasi Password:</label>
                <input type="password" name="password2" id="password2"
                    class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition duration-300"
                    placeholder="Confirm your password">
            </div>
            <button type="submit" name="registered"
                class="w-full bg-gradient-to-r from-pink-500 to-purple-500 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition transform hover:scale-105 duration-300">
                Register!
            </button>
        </form>
    </div>
</body>

</html>