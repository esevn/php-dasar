<?php

require 'koneksi.php';

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
