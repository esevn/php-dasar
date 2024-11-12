<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Santri SMA IT</title>
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
    </style>
</head>

<body class="bg-gradient-to-r from-purple-100 via-pink-100 to-red-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-6 shadow-lg">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center px-6">
            <h1 class="text-3xl font-bold mb-4 md:mb-0">📚 Data Santri SMA IT</h1>
            <form class="w-full max-w-lg relative" method="post" action="">
                <input type="search" name="keyword" id="search" class="w-full p-3 pl-12 pr-16 text-sm text-gray-800 border border-transparent rounded-full shadow-inner focus:outline-none focus:ring-2 focus:ring-purple-400 transition" placeholder="Cari Nama, Umur, dan lainnya..." required>
                <button type="submit" name="cari" class="absolute right-0 top-0 h-full bg-purple-500 hover:bg-purple-600 text-white font-semibold rounded-full px-6 transition">
                    Cari 🔍
                </button>
                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto flex-1 p-6">
        <div class="flex justify-end mb-6">
            <a href="create.php" class="bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-full shadow-lg flex items-center transition transform hover:scale-105">
                <i class="ph-light ph-plus-circle mr-2 text-xl"></i> Tambah Santri
            </a>
        </div>
        <?php if (empty($students)): ?>
            <div class="text-center py-6 text-gray-500">😕 Tidak ada data santri dengan nama itu.</div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($students as $index => $student): ?>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                        <div class="p-5">
                            <div class="flex items-center mb-4">
                                <img src="./img-profile/<?= htmlspecialchars($student["image"]) ?>" alt="<?= htmlspecialchars($student["name"]) ?>" class="w-16 h-16 object-cover rounded-full border-2 border-purple-300">
                                <div class="ml-4">
                                    <h2 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($student["name"]) ?></h2>
                                    <p class="text-sm text-gray-500"><?= htmlspecialchars($student["kelas"]) ?></p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <p><span class="font-semibold">Jenis Kelamin:</span> <?= htmlspecialchars($student["gender"]) ?></p>
                                <p><span class="font-semibold">Umur:</span> <?= htmlspecialchars($student["age"]) ?> tahun</p>
                                <p><span class="font-semibold">NIS:</span> <?= htmlspecialchars($student["nis"]) ?></p>
                                <p><span class="font-semibold">NIK:</span> <?= htmlspecialchars($student["nik"]) ?></p>
                                <p><span class="font-semibold">Alamat:</span> <?= htmlspecialchars($student["address"]) ?></p>
                            </div>
                        </div>
                        <div class="bg-gray-100 px-5 py-3 flex justify-end space-x-3">
                            <a href="edit.php?id=<?= $student['id'] ?>" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-2 rounded-full shadow-md transition transform hover:scale-110">
                                <i class="ph-light ph-pencil text-lg"></i>
                            </a>
                            <a href="delete.php?id=<?= $student['id'] ?>" onclick="return confirm('⚠️ Yakin mau dihapus nih?')" class="bg-red-400 hover:bg-red-500 text-white px-3 py-2 rounded-full shadow-md transition transform hover:scale-110">
                                <i class="ph-light ph-trash text-lg"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-center py-4">
        &copy; <?= date("Y") ?> SMA IT. Semua hak dilindungi. ✨
    </footer>
</body>

</html>