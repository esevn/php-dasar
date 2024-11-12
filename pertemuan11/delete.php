<?php

require 'koneksi.php';

$id = $_GET["id"];

function deleteStudent($id){
    global $koneksi;
    $query = "DELETE FROM students WHERE id = $id";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

echo deleteStudent($id);

?>