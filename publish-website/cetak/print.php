<?php
require_once __DIR__ . '/../vendor/autoload.php';
require "../function.php";
$students = getTables("students");

ob_start(); // Memulai output buffering yang berfungsi untuk menahan output dari file yang dituliskan.
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Santri</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 class="judul">Data Santri SMA IT</h1>
    <p>Total ada <?= count($students) ?> data santri</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jenis Kelamin</th>
                <th>Umur</th>
            </tr>
        </thead>
        <tbody>
            <?=
            $i = 1;
            foreach ($students as $student) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><img src="../img-profile/<?= $student["image"] ?>" alt="Photo" width="50"></td>
                    <td><?= $student["name"] ?></td>
                    <td><?= $student["class"] ?></td>
                    <td><?= $student["gender"] ?></td>
                    <td><?= $student["age"] ?> tahun</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
<?php
$html = ob_get_clean(); // Mengambil semua output buffering dan simpan ke variabel $html
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html); // Menuliskan HTML di variabel $html
// Output a PDF file directly to the browser
$mpdf->Output('myfile.pdf', 'I'); ?>