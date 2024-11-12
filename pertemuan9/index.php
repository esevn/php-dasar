<?php
require 'koneksi.php';

// Mengambil data dari database
$students = getData("SELECT * FROM students");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Data</title>
</head>

<body>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Actions</th>
            <th>Image</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>NIS</th>
            <th>NIK</th>
            <th>Class</th>
            <th>Address</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($students as $student) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td>
                    <a href="edit.php?id=<?= $student['id']; ?>">Edit</a> |
                    <a href="delete.php?id=<?= $student['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
                <td><img src="img/<?= $student["image"]; ?>" alt="" width="50"></td>
                <td><?= $student["name"]; ?></td>
                <td><?= $student["gender"]; ?></td>
                <td><?= $student["age"]; ?></td>
                <td><?= $student["nis"]; ?></td>
                <td><?= $student["nik"]; ?></td>
                <td><?= $student["class"]; ?></td>
                <td><?= $student["address"]; ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>

</html>