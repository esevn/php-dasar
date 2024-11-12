<?php
session_start(); 

if( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}

require 'connect.php';
$students = getTable("students");

if(isset($_POST["cari"]) ) {
  $students = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Students</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

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
</head>
<body class="bg-slate-300">
  


<div class="container flex flex-col justify-between mx-auto mt-10">
  <div class="flex justify-between ">
  <div class="flex p-2">
    <div class="p-2 rounded-lg mt-6 mb-4 ml-4 bg-blue-500 w-fit shadow-lg hover:bg-blue-950 transition-all ease-in-out duration-700">
        <a href="./create.php"><span class="font-bold text-xl">+</span> Add New?</a>
    </div>
    <div class=" p-2 rounded-lg mt-6 mb-4 ml-4 bg-blue-500 w-fit shadow-lg hover:bg-blue-950 transition-all ease-in-out duration-700">
        <a href="./logout.php">Logout?</a>
    </div>
    </div>
   <div class=" p-2 rounded-lg mt-6 mb-4 ml-4 bg-blue-500 w-fit shadow-lg hover:bg-blue-950 transition-all ease-in-out duration-700"> 
    <form action="" method="post">
    <input id="keyword" class="p-2 ring-blue-500 rounded-md" size="30" type="text" placeholder="seacrh" name="keyword" autocomplete="off" autofocus>
    <!-- <button id="search" class="bg-blue-400 hover:bg-slate-100 transition-all ease-in-out duration-700 text-black p-2 rounded-md" name="cari" type="submit">Search</button> -->
    </form>
    </div>
    </div>
    <div id="content" class="container flex flex-col item-center justify-center m-auto">
    <table class=" text-white" border="1" cellpadding="10" cellspacing="1">
        <tr class="bg-slate-500">
            <th>No</th>
            <th>Action</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Image</th>
            <th>NIS</th>
            <th>NIK</th>
            <th>Class</th>
            <th>Address</th>
        </tr>
        <?php $no = 1; ?>
        <?php foreach ($students as $student) :?>
        <tr class="border-b-2 border-black text-black">
            
            <td><?= $no ?></td>
            <td>
              <a class="text-white bg-blue-700 rounded-md hover:bg-blue-300 p-1" href="change.php?id=<?= $student["id"]?>"><i class="ph ph-pencil"></i></a> |
              <a class="text-white bg-red-700 rounded-md hover:bg-red-300 p-1" href="dele te.php?id=<?= $student["id"]?>" onclick="return confirm('Yakin Dek?');"><i class="ph ph-trash"></i></a>  
            </td>
            <td><?= $student['name']?></td>
            <td><?= $student['gender']?></td>
            <td><?= $student['age']?></td>
            <td><img src="./img/<?= $student ["image"]?>" width="50px" alt="" class="rounded-lg"></td>
            <td><?= $student['nis']?></td>
            <td><?= $student['nik']?></td>
            <td><?= $student['class']?></td>
            <td><?= $student['address']?></td>
    
        </tr>
        <?php $no++ ?>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
  <script src="js/jquery.js"></script>
  <script src="js/script.js"></script>
</body>
</html>