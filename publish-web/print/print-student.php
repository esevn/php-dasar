<?php
require_once __DIR__ . '/../vendor/autoload.php';

require './../connect.php';
$students = getTable("students");
// var_dump($students);
// die;
$mpdf = new \Mpdf\Mpdf();
$html = '';
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>  
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Student</title>
</head>
<body>
    <h1> Data Students </h1>
        <table>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Image</th>
            <th>NIS</th>
            <th>NIK</th>
            <th>Class</th>
            <th>Address</th>
        </tr>';

        $no = 1;
        foreach ($students as $student){
            $html .= '<tr> 
             <td>'. $no++ .'</td>
             <td>'. $student['name'].'</td>
            <td>'. $student['gender'].'</td>
            <td>'. $student['age'].'</td>
             <td><img src="./../img/'. $student ["image"] .'" width="50px"></td>
             <td>'. $student['nis'] .'</td>
            <td>'. $student['nik'] .'</td>
            <td>'. $student['class'] .'</td>
            <td>'. $student['address'] .'</td>
            </tr>'; 
        }
    $html .= '</table>
</body>
</html>';
$mpdf->WriteHTML($html); 
$mpdf->Output('data students.pdf', 'I');
?>

