<?php
require "function.php";
$keyword = $_GET["keyword"];
$students = "";

// Pagenation configuration
$limit = 3; // Data per page
$pageActive = isset($_GET["page"]) ? $_GET["page"] : 1; // Halaman yang aktif
$lenght = count(getTables("students")); // Total data
$countPage = ceil($lenght / $limit); // Total page


// Kalkulasi mulai halaman
$startData = $limit * $pageActive - $limit;
$no = $startData + 1;

// Get data from database
$prev = ($pageActive > 1) ? $pageActive - 1 : 1;
$next = ($pageActive < $countPage) ? $pageActive + 1 : $countPage;

if (!$keyword) {
    $students = getTables("students", $startData, $limit);
} else {
    $students = cari($keyword, $startData, $limit);
}


?>
<main id="container" class="container mx-auto flex-1">
    <div class="flex justify-end mb-6">
        <a href="create.php" class="bg-gray-800 hover:bg-gray-700 text-white px-5 py-3 rounded-full shadow-lg flex items-center transition transform hover:scale-105">
            <i class="ph-light ph-plus-circle mr-2 text-xl"></i> Tambah Santri
        </a>
    </div>
    <?php if (empty($students)): ?>
        <div class="text-center py-6 text-gray-500">😕 Tidak ada data santri dengan nama itu.</div>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Jenis Kelamin</th>
                        <th>Umur</th>
                        <th>NIS</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $index => $student): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><img src="./img-profile/<?= htmlspecialchars($student["image"]) ?>" alt="<?= htmlspecialchars($student["name"]) ?>"></td>
                            <td><?= htmlspecialchars($student["name"]) ?></td>
                            <td><?= htmlspecialchars($student["class"]) ?></td>
                            <td><?= htmlspecialchars($student["gender"]) ?></td>
                            <td><?= htmlspecialchars($student["age"]) ?> tahun</td>
                            <td><?= htmlspecialchars($student["nis"]) ?></td>
                            <td><?= htmlspecialchars($student["nik"]) ?></td>
                            <td><?= htmlspecialchars($student["address"]) ?></td>
                            <td class="flex items-center space-x-2">
                                <a href="edit.php?id=<?= $student['id'] ?>" class="action-button edit-button">
                                    <i class="ph-light ph-pencil"></i> Edit
                                </a>
                                <a href="delete.php?id=<?= $student['id'] ?>" onclick="return confirm('⚠️ Yakin mau dihapus nih?')" class="action-button delete-button">
                                    <i class="ph-light ph-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
        <nav class="flex justify-center mt-6" aria-label="Page navigation example">
            <div class="flex items-center -space-x-px h-10 text-base">
                <span>
                    <a href="?page=<?= $prev ?>" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                        <span class="sr-only">Previous</span>
                        <svg class="w-3 h-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                        </svg>
                    </a>
                </span>
                <?php for ($i = $pageActive; $i > $countPage - 3; $i--): ?>
                    <span>
                        <a href="?page=<?= $i ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"><?= $i ?></a>
                    </span>
                <?php endfor; ?>
                <span>
                    <a href="index.php?page=<?= $next ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                        <span class="sr-only">Next</span>
                        <svg class="w-3 h-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                    </a>
                </span>
            </div>
        </nav>
    <?php endif; ?>
</main>