
<?php

$server = "localhost";
$user = "root";
$password = "";
$database = "blog_school";

// Membuat koneksi ke database
$koneksi = mysqli_connect($server, $user, $password, $database);

// Pengecekan koneksi
if (!$koneksi) {
    die("Gagal Terhubung ke Database : " . mysqli_connect_error());
}

// Fungsi untuk mengambil data dari database
function getData($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
