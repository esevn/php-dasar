<?php
require './../connect.php';

$keyword = $_GET["cari"];
$students = cari($keyword, 0, 2 );
// var_dump($student);


?>

<table class=" text-white" border="1" cellpadding="10" cellspacing="1">
        <tr class="bg-slate-500">
            <th>No.</th>
            <th>Action</th>
            <th>Name.</th>
            <th>Gender.</th>
            <th>Age.</th>
            <th>Image.</th>
            <th>NIS.</th>
            <th>NIK.</th>
            <th>Class.</th>
            <th>Address.</th>
        </tr>
        <?php $no = 1; ?>
        <?php foreach ($students as $student) :?>
        <tr class="border-b-2 border-black text-black">
            
            <td><?= $no ?></td>
            <td>
              <a class="text-white bg-blue-700 rounded-md hover:bg-blue-300 p-1" href="change.php?id=<?= $student["id"]?>"><i class="ph ph-pencil"></i></a> |
              <a class="text-white bg-red-700 rounded-md hover:bg-red-300 p-1" href="delete.php?id=<?= $student["id"]?>" onclick="return confirm('Yakin Dek?');"><i class="ph ph-trash"></i></a>  
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