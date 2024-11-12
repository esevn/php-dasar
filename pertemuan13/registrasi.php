<?php
require 'koneksi.php';

if (isset($_POST["registered"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>alert('Username ditambahkan!');
        document.location.href = 'index.php'
        script>";
    } else
        echo mysqli_error($koneksi);
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

<body>


    <h1 class="text-center py-6 text-xl uppercase font-bold">Halaman Registrasi</h1>


    <form action="" method="post" class="max-w-md mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <ul class="space-y-4">
            <li class="flex flex-col">
                <label for="username" class="text-gray-700 font-medium mb-1">Username:</label>
                <input type="text" name="username" id="username"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Enter your username">
            </li>
            <li class="flex flex-col">
                <label for="password" class="text-gray-700 font-medium mb-1">Password:</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Enter your password">
            </li>
            <li class="flex flex-col">
                <label for="password2" class="text-gray-700 font-medium mb-1">Konfirmasi Password:</label>
                <input type="password" name="password2" id="password2"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Confirm your password">
            </li>
            <li>
                <button type="submit" name="registered"
                    class="w-full bg-blue-500 text-white py-2 mt-4 rounded-md hover:bg-blue-600 transition duration-300">
                    Register!
                </button>
            </li>
        </ul>
    </form>
</body>

</html>