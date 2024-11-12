<?php

require 'koneksi.php';

$id = $_GET["id"];

function delete($id, $table)
{
    global $koneksi;
    $query = "DELETE FROM $table WHERE id = $id";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

if (delete($id, $table) > 0) {
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
