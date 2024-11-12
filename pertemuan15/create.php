<?php

session_start();

require 'koneksi.php';

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["submit"])) {
    insertDataStudents($_POST, $_FILES);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1E40AF',
                        secondary: '#F9FAFB',
                        accent: '#3B82F6',
                        danger: '#EF4444',
                        success: '#10B981',
                    }
                }
            }
        }
    </script>

    <style>
        input {
            border: 2px solid red;
            border-radius: 4px;
            box-shadow: 2px 2px 5px #fff;

        }
    </style>
    <title>Document</title>
</head>

<body>
    <div class="container flex flex-col items-center justify-center mx-auto my-10 p-5">
        <a href="index.php"><button class="px-6 py-3 my-4 bg-blue-600 hover:bg-blue-700 rounded-lg text-white font-medium transition duration-200">
                Back to Home
            </button>

        </a>
        <form action="" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" id="name" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:border-transparent">
            <select name="gender" id="" require>
                <option value="laki-laki">laki-laki</option>
                <option value="perempuan">perempuan</option>
            </select>
            <br>
            <label for="age">Umur</label>
            <input type="number" name="age" id="age" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:border-transparent">
            <label for="image">Gambar</label>
            <input type="file" name="image" id="image" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:border-transparent">
            <label for="nis">NIS</label>
            <input type="number" name="nis" id="nis" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:border-transparent">
            <label for="nik">NIK</label>
            <input type="number" name="nik" id="nik" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:border-transparent">
            <label for="class">Kelas</label>
            <input type="number" name="class" id="class" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:border-transparent">
            <label for="address">Alamat</label>
            <textarea name="address" id="address" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:border-transparent"></textarea>
            <button type="submit" name="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg transition duration-200">Kirim Data</button>

        </form>
    </div>
</body>

</html>