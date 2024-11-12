<?php
session_start();
require "function.php";

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// Pagenation configuration
$limit = 3; // Data per page
$pageActive = isset($_GET["page"]) ? $_GET["page"] : 1; // Halaman yang aktif
$lenght = count(getTables("students")); // Total data
$countPage = ceil($lenght / $limit); // Total page


// Kalkulasi mulai halaman
$startData = $limit * $pageActive - $limit;
$no = $startData + 1;

// Get data from database
$students = getTables("students", $startData, $limit);

$prev = ($pageActive > 1) ? $pageActive - 1 : 1;
$next = ($pageActive < $countPage) ? $pageActive + 1 : $countPage;

// echo $lenght;
// die;
if (isset($_POST["cari"])) {
    $keyword = htmlspecialchars($_POST["keyword"]);
    $students = cari($keyword);
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Santri SMA IT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Icon Library (Phosphor Icons) -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <!-- JQuery -->
    <script src="./js/jquery-3.7.1.js"></script>
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

        /* Custom styling with gradient */
        body {
            background: linear-gradient(135deg, #f7fafc, #e2e8f0);
            font-family: 'Inter', sans-serif;
            color: #2d3748;
        }

        header {
            background: linear-gradient(90deg, #2c3e50, #4a5568);
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 15px 20px;
            text-align: left;
        }

        th {
            background-color: #2d3748;
            color: white;
            font-size: 14px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        td {
            font-size: 15px;
            font-weight: 500;
            color: #4a5568;
        }

        /* Zebra stripe rows */
        tr:nth-child(even) {
            background-color: #f7fafc;
        }

        tr:hover {
            background-color: #edf2f7;
            /*transform: translateY(-2px);*/
            transition: all 0.2s ease;
            cursor: pointer;
        }

        td img {
            border-radius: 50%;
            width: 48px;
            height: 48px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Elegant button design */
        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            font-size: 14px;
            font-weight: 600;
            border-radius: 5px;
            transition: transform 0.2s ease;
        }

        .edit-button {
            background-color: #f6ad55;
            color: white;
        }

        .edit-button:hover {
            background-color: #dd6b20;
        }

        .delete-button {
            background-color: #fc8181;
            color: white;
        }

        .delete-button:hover {
            background-color: #e53e3e;
        }

        td a:hover {
            transform: scale(1.05);
        }

        .logout-button {
            background-color: #2d3748;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            transition: background-color 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        .logout-button:hover {
            background-color: #1a202c;
        }

        /* Responsive Table */
        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            th,
            td {
                padding: 10px 15px;
            }

            td img {
                width: 40px;
                height: 40px;
            }
        }

        footer {
            background: linear-gradient(90deg, #2c3e50, #4a5568);
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 14px;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">

    <!-- Header -->
    <header class="py-6">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center px-6">
            <h1 class="text-3xl font-bold mb-4 md:mb-0">📚 Data Santri SMA IT</h1>
            <div class="flex items-center space-x-4">
                <form class="print:hidden w-full max-w-lg relative" method="post" action="">
                    <input type="search" name="keyword" id="keyword" class="w-full p-3 pl-12 pr-16 text-sm text-gray-800 rounded-full shadow-inner focus:outline-none focus:ring-2 focus:ring-gray-500 transition" placeholder="Cari..." required>
                    <button type="submit" name="cari" id="search" class="absolute right-0 top-0 h-full bg-gray-800 hover:bg-gray-700 text-white font-semibold rounded-full px-6 transition">
                        Cari 🔍
                    </button>
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </form>
                <!-- Logout Button -->
                <a href="logout.php" class="logout-button">
                    <i class="ph-light ph-sign-out mr-2"></i> Logout
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main id="container" class="container mx-auto flex-1 p-6">
        <div class="flex justify-end gap-2 mb-6">
            <a href="create.php" class="bg-gray-800 hover:bg-gray-700 text-white px-5 py-3 rounded-full shadow-lg flex items-center transition transform hover:scale-105">
                <i class="ph-light ph-plus-circle mr-2 text-xl"></i> Tambah Santri
            </a>
            <a href="./cetak/print.php" data-tooltip-target="tooltip-animation" class="bg-green-500 hover:bg-green-700 text-white px-5 py-3 rounded-full shadow-lg flex items-center transition transform hover:scale-105">
                <i class="ph ph-printer text-lg"></i>
            </a>
            <div id="tooltip-animation" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-700 rounded-lg shadow-sm opacity-0 tooltip">
                Print
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
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
                                <td><?= $no++ ?></td>
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
                                    <a href="delete.php?id=<?= $student['id'] ?>" id="btn_del" class="action-button delete-button">
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

    <!-- Footer -->
    <footer class="text-white text-center py-4">
        &copy; <?= date("Y") ?> SMA IT. Semua hak dilindungi. ✨
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
        var keyword = $("#keyword")
        var container = $("#container")

        keyword.on("keyup", () => {
            // console.log(keyword.val())
            container.load("search.php?keyword=" + keyword.val())
        })

        var btn_del = $("#btn_del");
        btn_del.on("click", () => {
            return confirm("Apakah anda yakin ingin menghapus data ini?");
        })
    </script>
</body>

</html>