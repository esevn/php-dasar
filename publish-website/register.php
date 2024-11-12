<?php
require 'function.php';

if (isset($_POST["register"])) {
    if (register($_POST) > 0) {
        echo "
        <script>
        alert('Yeay!, Register Berhasil!');
        document.location.href = 'login.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Gagal!, Register Gagal!');
        //document.location.href = 'register.php';
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegant Registration</title>
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
        <h2 class="text-2xl font-extrabold mb-5">Create Your Account</h2>

        <!-- Username Input -->
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm">email or username</label>
            <input type="name" id="email" name="email" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="Your username" required />
        </div>

        <!-- Password Input -->
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm">Password</label>
            <input type="password" id="password" name="password" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="masukkan password" required />
        </div>

        <!-- COnfirm Password Input -->
        <div class="mb-5">
            <label for="confirm-password" class="block mb-2 text-sm">Confirm Password</label>
            <input type="password" name="confirm-password" id="confirm-password" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" placeholder="••••••••" required />
            <p id="password-match"></p>
        </div>

        <!-- Remember Me Checkbox -->
        <div class="flex items-start mb-5">
            <div class="flex items-center h-5">
                <input id="remember" type="checkbox" class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 dark:focus:ring-purple-600 focus:ring-2" />
            </div>
            <label for="remember" class="ml-2 text-sm font-medium text-gray-900">Remember me</label>
        </div>

        <!-- Submit Button -->
        <button type="submit" name="register" class="w-full bg-gray-700 hover:bg-gray-900 text-white font-semibold rounded-lg text-sm text-center focus:outline-none focus:ring-4 focus:ring-purple-300 px-4 py-3">Submit</button>

        <!-- Register Button -->
        <button type="button" onclick="window.location.href='login.php';" class="w-full mt-3 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-lg text-sm text-center focus:outline-none focus:ring-4 focus:ring-gray-200 px-4 py-3">
            Login
        </button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>