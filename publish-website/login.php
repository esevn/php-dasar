<?php
session_start();

require 'function.php';
$username = '';
if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
}

if (isset($_SESSION['login'])) {
    header('Location: index.php');
    exit;
}

if (isset($_POST["login"])) {
    $remember = $_POST["remember"];
    $result = login($_POST);
    if ($result !== false) {
        if (isset($remember)) {
            setcookie("username", $result["username"], time() + 60);
        }
        $_SESSION["login"] = true;
        header("Location: index.php");
        exit;
        echo "
        <script>
        alert('berhasil login')
        document.location.href = 'index.php'
        </script>
        ";
    } else {
        echo "
        <script>
        alert('username / password salah');
        </script>
        ";
        die;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        /* Custom styling for elegant design */
        body {
            background: linear-gradient(135deg, #f0f4f8, #d9e3f0);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
        }

        form {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            max-width: 400px;
            width: 100%;
        }

        form:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        input:focus {
            box-shadow: 0 0 5px #7e57c2, 0 0 15px #7e57c2;
            transition: box-shadow 0.2s ease-in-out;
        }

        label {
            font-weight: 600;
            color: #555;
        }

        h2 {
            font-size: 1.75rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .salah {
            color: red;
            font-style: italic;
            font-size: 12px;
            margin-top: 2px;
            opacity: .5;
            letter-spacing: 1px;
        }

        .hidden {
            display: none;
        }

        ::placeholder {
            color: #bbb;
        }
    </style>
</head>

<body>
    <form class="p-6" method="post" action="">
        <h2 class="text-2xl font-extrabold mb-5">Log In To Your Account</h2>

        <!-- Username Input -->
        <div class="mb-5">
            <label for="username" class="block mb-2 text-sm">Email</label>
            <input type="name" id="username" name="username" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Your email or Username" required value="<?= $username ?>" />
        </div>

        <!-- Password Input -->
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm">Password</label>
            <input type="password" id="password" name="password" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Your password" required />
        </div>

        <!-- Remember Me Checkbox -->
        <div class="flex items-start mb-5">
            <div class="flex items-center h-5">
                <input id="remember" name="remember" type="checkbox" class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2" />
            </div>
            <label for="remember" class="ml-2 text-sm font-medium text-gray-900">Remember me</label>
        </div>

        <!-- Submit Button -->
        <button type="submit" name="login" class="w-full bg-gray-700 hover:bg-gray-900 text-white font-semibold rounded-lg text-sm text-center focus:outline-none focus:ring-4 focus:ring-purple-300 px-4 py-3">Log In</button>

        <!-- Register Button -->
        <button type="button" onclick="window.location.href='register.php';" class="w-full mt-3 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-lg text-sm text-center focus:outline-none focus:ring-4 focus:ring-gray-200 px-4 py-3">
            Register
        </button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>