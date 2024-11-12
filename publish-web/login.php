<?php

session_start();
require 'connect.php';
;

if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($connect, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if( $key === hash('sha256', $row['username']) ){
        $_SESSION['login'] = true;
    }
}

if( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}

$error = false; 

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $connect->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;

            if(isset($_POST['remember']) ){
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }
            header("Location: index.php");
            exit;
        }
    }

    $error = true; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-purple-300">
    <?php if ($error): ?>
        <script> alert('Wrong Password or Username!'); </script>
    <?php endif; ?>
    <form action="" method="post" class="max-w-sm mx-auto mt-8 bg-gradient-to-tr from-black to-purple-500 rounded-lg shadow-lg shadow-blue-600 p-6">
        <h1 class="text-center font-bold text-4xl mb-4 text-white">Login Wak😊</h1>
        <div class="mb-5">
            <label for="username" class="block mb-2 text-sm font-medium text-white dark:text-white">Namaewa</label>
            <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="input ur name" required />
        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium dark:text-white text-white">Password</label>
            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="passwordewa?" required />
        </div>
        <div class="flex items-start mb-5">
        <div class="flex items-center h-5">
        <input id="remember" name="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required />
        </div>
        <label for="remember" class="ms-2 text-sm font-medium text-white dark:text-gray-300">Remember me</label>
        </div>
        <div class="flex justify-between mt-40">
        <button type="submit" name="login" class="text-white bg-blue-700 hover:bg-blue-950 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Login!</button>
        
        <button type="submit" name="registered" class="text-white bg-blue-700 hover:bg-blue-950 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"><a href="./register.php">Register</a></button>
        </div>
    </form>
</body>
</html>
