<?php

session_start();

require 'koneksi.php';

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

$id = $_GET["id"];

if (delete($id, "students") > 0) {
    echo "
            <script>
                alert('Datamu Berhasil Dihapus!');
                document.location.href = 'index.php';
            </script>
        ";
} else {
    echo "
            <script>
                alert('Datamu Gagal Dihapus!');
                document.location.href = 'index.php';
            </script>
        ";
}
