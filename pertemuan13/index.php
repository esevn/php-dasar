<?php
require 'koneksi.php';

$students = getData("students");

if (isset($_POST["cari"])) {
  $students = cari($_POST["keyword"]);
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

  <title>Document</title>
</head>

<body class="bg-gray-100 font-sans antialiased">
  <a href="create.php">
    <button class="px-6 py-3 bg-primary text-white rounded-md font-semibold shadow-lg hover:bg-accent transition duration-300 m-4
    ">Tambah Data </button></a>
  <form action="" method="post">
    <input type="text" name="keyword" size="40" autofocus placeholder="Cari Keyword" autocomplete="off">
    <button type="submit" name="cari">Cari</button>
  </form>
  <table cellpadding="10" class="min-w-full bg-white shadow-md rounded-lg overflow-hidden mx-auto">
    <tr class=" border-2">
      <th class="py-3 px-5">No</th>
      <th class="py-3 px-5">image</th>
      <th class="py-3 px-5">name</th>
      <th class="py-3 px-5">gender</th>
      <th class="py-3 px-5">age</th>
      <th class="py-3 px-5">Nis</th>
      <th class="py-3 px-5">Nik</th>
      <th class="py-3 px-5">class</th>
      <th class="py-3 px-5">address</th>
      <th class="py-3 px-5">Action</th>
    </tr>
    <?php $no = 1; ?>
    <?php foreach ($students as $student) : ?>
      <tr class="border border-b border-gray-200 hover:bg-gray-100 transition duration-300">
        <td><?= $no; ?></td>
        <td><?= $student['name'] ?></td>
        <td><?= $student['gender'] ?></td>
        <td><?= $student['age'] ?></td>
        <td><img src="./img/<?= $student['image'] ?>" width="50px"></td>
        <td><?= $student['nis'] ?></td>
        <td><?= $student['nik'] ?></td>
        <td><?= $student['class'] ?></td>
        <td><?= $student['address'] ?></td>
        <td>
          <div class="flex gap-3"><a href="edit.php?id=<?= $student['id']; ?>">
              <div class="bg-green-500 px-3 py-3 rounded-lg cursor-pointer hover:brightness-75"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-white" viewBox="0 0 256 256">
                  <path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z"></path>
                </svg></div>
            </a>

            <a href="delete.php?id=<?= $student['id']; ?>" onclick="return confirm('yakin ni??')">
              <div onclick="" class="bg-red-500 px-3 py-3 rounded-lg cursor-pointer hover:brightness-75"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-white" viewBox="0 0 256 256">
                  <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"></path>
                </svg></div>
            </a>
          </div>
        </td>
      </tr>
      <?php $no++; ?>
    <?php endforeach; ?>
  </table>
</body>

</html>