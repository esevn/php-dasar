<?php
require 'function.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "<script>
        alert('ID tidak valid!');
        window.location.href = 'index.php';
    </script>";
    exit;
}

if (isset($_POST["submit"])) {
    $data = $_POST;
    if (updateData($data, $id, $_FILES) > 0) {
        echo "<script>
            alert('Data berhasil diperbarui!');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diperbarui!');
        </script>";
    }
}

$student = showDataStudents($id);
if (!$student) {
    echo "<script>
        alert('Data tidak ditemukan!');
        window.location.href = 'index.php';
    </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Santri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
        <header class="mb-6">
            <h1 class="text-3xl font-extrabold text-center text-slate-600">Edit Data Santri</h1>
        </header>
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="oldImage" value="<?= htmlspecialchars($student[0]['image']) ?>">
            <!-- Nama -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required value="<?= htmlspecialchars($student[0]['name']) ?>">
            </div>
            <!-- Gender -->
            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="gender" id="gender" class="mt-1 block w-full p-2.5 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="Laki-laki" <?= $student[0]['gender'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $student[0]['gender'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <!-- Umur -->
            <div>
                <label for="age" class="block text-sm font-medium text-gray-700">Umur</label>
                <input type="number" name="age" id="age" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required value="<?= htmlspecialchars($student[0]['age']) ?>">
            </div>
            <!-- Gambar -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <div class="w-28 h-28">
                    <img src="./img-profile/<?= htmlspecialchars($student[0]['image']) ?>" alt="gambar">
                </div>
            </div>
            <!-- NIS -->
            <div>
                <label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
                <input type="number" name="nis" id="nis" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required value="<?= htmlspecialchars($student[0]['nis']) ?>">
            </div>
            <!-- NIK -->
            <div>
                <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                <input type="number" name="nik" id="nik" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required value="<?= htmlspecialchars($student[0]['nik']) ?>">
            </div>
            <!-- Kelas -->
            <div>
                <label for="class" class="block text-sm font-medium text-gray-700">Kelas</label>
                <input type="number" name="class" id="class" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required value="<?= htmlspecialchars($student[0]['class']) ?>">
            </div>
            <!-- Alamat -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                <input type="text" name="address" id="address" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required value="<?= htmlspecialchars($student[0]['address']) ?>">
            </div>
            <!-- Tombol Submit dan Batal -->
            <div class="flex justify-between items-center">
                <button type="submit" name="submit" class="w-full bg-slate-600 text-white font-medium py-2 px-4 rounded-lg hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <i class="ph-light ph-pencil mr-2"></i> Edit
                </button>
                <a href="index.php" class="w-full bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 ml-2">
                    <i class="ph-light ph-x-circle mr-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</body>

</html>