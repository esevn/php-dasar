<?php
session_start(); 

if( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}

require 'connect.php';

$id = $_GET["id"];
$student = showDataStudent($id);

if (isset($_POST["submit"])) {
    $data = $_POST;
    if (change($data, $id) > 0) {
        echo "
              <script> 
                  alert('Success! Changes have been made successfully.');
                  document.location.href = 'index.php';
              </script>";
    } else {
        echo "
              <script> 
                  alert('Change Failed!');
                  document.location.href = 'index.php';
              </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change</title>
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
    <form action="" method="post" enctype="multipart/form-data" class="max-w-sm mx-auto mt-8 bg-white rounded-lg shadow-lg shadow-blue-600 p-6">
        <input type="hidden" name="id" value="<?= $student[0]["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $student[0]["image"]; ?>">
        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Namaewa</label>
            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="input ur name" required value="<?= $student[0]["name"]; ?>" />
        </div>
        <div class="mb-5">
            <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">genderwa</label>
            <input type="text" name="gender" placeholder="genderwa" id="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="<?= $student[0]["gender"]; ?>" />
        </div>
        <div class="mb-5">
            <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">age</label>
            <input type="text" name="age" placeholder="age" id="age" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="<?= $student[0]["age"]; ?>" />
        </div>
        <div class="mb-5">
            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">image</label>
            <img src="./img/<?= $student [0]["image"]?>" width="70px" alt="" class="rounded-lg mb-4">
            <input type="file" name="image" placeholder="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        </div>
        <div class="mb-5">
            <label for="nis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">nis</label>
            <input type="text" name="nis" placeholder="nis" id="nis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="<?= $student[0]["nis"]; ?>" />
        </div>
        <div class="mb-5">
            <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">nik</label>
            <input type="text" name="nik" placeholder="nik" id="nik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="<?= $student[0]["nik"]; ?>" />
        </div>
        <div class="mb-5">
            <label for="class" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">class</label>
            <input type="text" name="class" placeholder="class" id="class" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="<?= $student[0]["class"]; ?>" />
        </div>
        <div class="mb-5">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">address</label>
            <input type="text" name="address" placeholder="alamat" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="<?= $student[0]["address"]; ?>" />
        </div>
        <!-- <div class="flex items-start mb-5">
            <div class="flex items-center h-5">
                <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required />
            </div>
            <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
        </div> -->
        <button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-950 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 transition-all ease-in-out duration-500 dark:focus:ring-blue-800">GAASS!</button>
    </form>
    <a href="./index.php">
        <div class="flex justify-center items-center p-2 rounded-lg mt-6 mb-4 ml-4 bg-blue-500 w-32 h-10 shadow-lg shadow-blue-500 hover:bg-blue-950 transition-all ease-in-out duration-700">Back?</div>
    </a>
</body>

</html>
