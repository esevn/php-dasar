<?php
require 'function.php';

if (isset($_POST["submit"])) {
    // var_dump($_POST);
    // var_dump($_FILES);
    // die();
    if (insertData($_POST, $_FILES) > 0) {
        echo "<script>
        alert('Kamu berhasil mengirim !');
        window.location.href = 'index.php'
        </script>";
    } else {
        echo "<script>
        alert('Kamu gagal mengirim !');
        //window.location.href = 'index.php'
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Santri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Icon Library (Phosphor Icons) -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #a0aec0;
            border-radius: 10px;
            border: 2px solid #f1f1f1;
        }

        /* Styling for file input */
        .file-input {
            display: none;
        }

        .file-label {
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-gray-100 via-gray-200 to-gray-300 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-lg bg-white shadow-lg rounded-xl p-8">
        <header class="mb-8 text-center">
            <h1 class="text-3xl font-semibold text-gray-800 flex items-center justify-center">
                <i class="ph-light ph-user-plus mr-2 text-2xl"></i> Tambah Data Santri
            </h1>
            <p class="mt-1 text-gray-500">Isi formulir di bawah untuk menambahkan data santri baru</p>
        </header>
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-5">
            <!-- Nama -->
            <div class="relative">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <div class="mt-1">
                    <input type="text" name="name" id="name" class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-500 transition" placeholder="Masukkan nama santri">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                        <i class="ph-light ph-user text-xl"></i>
                    </span>
                </div>
            </div>
            <!-- Jenis Kelamin -->
            <div class="relative">
                <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <div class="mt-1">
                    <select name="gender" id="gender" class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-500 transition">
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                        <option value="Non-binary">Non-binary</option>
                    </select>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                        <i class="ph-light ph-caret-down text-xl"></i>
                    </span>
                </div>
            </div>
            <!-- Umur -->
            <div class="relative">
                <label for="age" class="block text-sm font-medium text-gray-700">Umur</label>
                <div class="mt-1">
                    <input type="number" name="age" id="age" min="1" class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-500 transition" placeholder="Masukkan umur">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                        <i class="ph-light ph-number text-xl"></i>
                    </span>
                </div>
            </div>
            <!-- Gambar -->
            <div class="relative">
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                <div class="mt-1 flex items-center">
                    <label for="image" class="file-label flex items-center justify-center w-full px-4 py-3 bg-gray-50 border border-dashed border-gray-300 rounded-lg shadow-sm hover:bg-gray-100 transition cursor-pointer">
                        <i class="ph-light ph-upload text-2xl text-gray-500 mr-2"></i> Pilih Gambar
                    </label>
                    <input type="file" name="image" id="image" accept="image/*" class="file-input">
                </div>
                <p class="mt-2 text-sm text-gray-500">Format yang diperbolehkan: JPG, PNG, JPEG.</p>
                <!-- Nama File -->
                <p id="file-name" class="mt-2 text-sm text-gray-700"></p>
            </div>
            <!-- NIS -->
            <div class="relative">
                <label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
                <div class="mt-1">
                    <input type="number" name="nis" id="nis" min="1" class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-500 transition" placeholder="Masukkan NIS">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                        <i class="ph-light ph-id-card text-xl"></i>
                    </span>
                </div>
            </div>
            <!-- NIK -->
            <div class="relative">
                <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                <div class="mt-1">
                    <input type="number" name="nik" id="nik" min="1" class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-500 transition" placeholder="Masukkan NIS">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                        <i class="ph-light ph-id-card text-xl"></i>
                    </span>
                </div>
            </div>
            <!-- Kelas -->
            <div class="relative">
                <label for="class" class="block text-sm font-medium text-gray-700">Kelas</label>
                <div class="mt-1">
                    <input type="number" name="class" id="class" min="1" class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-500 transition" placeholder="Masukkan NIS">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                        <i class="ph-light ph-id-card text-xl"></i>
                    </span>
                </div>
            </div>
            <!-- Alamat -->
            <div class="relative">
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                <div class="mt-1">
                    <input type="text" name="address" id="address" min="1" class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-500 transition" placeholder="Masukkan NIS">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                        <i class="ph-light ph-id-card text-xl"></i>
                    </span>
                </div>
            </div>
            <!-- Tombol Submit dan Batal -->
            <div class="flex justify-between items-center mt-6">
                <button type="submit" name="submit" class="flex items-center justify-center w-full bg-gray-800 text-white font-semibold py-3 px-5 rounded-lg shadow-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2 transition">
                    <i class="ph-light ph-paper-plane mr-2 text-lg"></i> Kirim
                </button>
                <a href="index.php" class="flex items-center justify-center w-full bg-gray-400 text-white font-semibold py-3 px-5 rounded-lg shadow-md hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ml-2 text-center">
                    <i class="ph-light ph-x-circle mr-2 text-lg"></i> Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        const imageInput = document.getElementById('image');
        const fileNameDisplay = document.getElementById('file-name');

        imageInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                fileNameDisplay.textContent = `Nama File: ${this.files[0].name}`;
            } else {
                fileNameDisplay.textContent = '';
            }
        });
    </script>

</body>

</html>