<?php

require 'koneksi.php';

$id = $_GET["id"];
$student = showDataStudent("id");
// var_dump($student);


if (isset($_POST["submit"])) {
    if (updateDataStudent($_POST, $id) > 0) {
        echo "<script>alert('data berhasil diubah');
        document.location.href = 'index.php'
        script>";
    } else {
        echo "<script>alert('data gagal diubah') </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
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
</head>

<body>
    <div class="container flex flex-col items-center justify-center bg-white">
        <form action="" method="POST" class="bg-slate-400 border m-auto py-4 flex w-full flex-col gap-4 border-black items-center justify-center">
            <input type="hidden" name="id" value="<?= $student["id"]; ?>">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" id="name" required value="<?= $student[0]['name'] ?>">
            <label for="gender">Jeniz Kelamin</label>
            <select name="gender" id="gender" require>
                <option value="laki-laki">Male</option>
                <option value="perempuan">Vamale</option>
            </select>
            <label for="age">Umur</label>
            <input type="number" name="number" id="age" required value="<?= $student[0]['age'] ?>">
            <label for="image">Gambar</label>
            <input type="text" name="image" id="image" required value="<?= $student[0]['image'] ?>">
            <label for="nis">NIS</label>
            <input type="number" name="nis" id="nis" required value="<?= $student[0]['nis'] ?>">
            <label for="nik">NIK</label>
            <input type="number" name="nik" id="nik" required value="<?= $student[0]['nik'] ?>">
            <label for="class">Kelas</label>
            <input type="number" name="class" id="class" required value="<?= $student[0]['class'] ?>">
            <label for="address">Alamat</label>
            <input type="text" name="address" id="address" required value="<?= $student[0]['address'] ?>">
            <div class="form-check mb-1">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                </label>
            </div>
            <button type="submit" name="submit" class="bg-red-500 px-4 py-4 rounded-md text-white transition-all hover:rotate-180">Kirim data</button>
        </form>
    </div>
</body>

</html>