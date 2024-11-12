<?php

session_start();

require 'koneksi.php';

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    // $result = $login($_POST);
    if ($result !== false) {
        $_SESSION["login"] = true;
        header("Location: index.php");
        exit;
        $user = $result["username"];
        // echo "<script>alert('Berhasil Login! $user'); 
        //         document.location.href = 'index.php';
        //     </script>";
    } else {
        echo
        "<script>alert('Username atau Password Salah!'); 
                document.location.href = 'index.php';
            </script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-purple-500 to-indigo-600 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-sm bg-white rounded-lg shadow-lg p-6 space-y-4">
        <h1 class="text-2xl font-bold text-center text-gray-800">Login</h1>

        <form action="" method="post" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <button type="submit" name="login" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition">Login</button>
            </div>
        </form>
    </div>

</body>

</html>