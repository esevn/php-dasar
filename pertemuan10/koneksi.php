<?php

$server = "localhost";
$user = "root";
$pass = "";
$database = "blog_school";

$koneksi = mysqli_connect($server, $user, $pass, $database);

if (!$koneksi) {
    echo "gagal terhubung ke database :" . mysqli_connect_error();
}

function getdata($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function showDataStudent($id)
{
    global $koneksi;
    $query = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function insertDataStudents($data)
{
    global $koneksi;
    //var_dump($data);
    $name = htmlspecialchars($data["name"]);
    $gender = $data["gender"];
    $age = $data["age"];
    $image = $data["image"];
    $nis = $data["nis"];
    $nik = $data["nik"];
    $class = $data["class"];
    $address = $data["address"];

    $query = "INSERT INTO students VALUES
    (null, '$name', '$gender', '$age', '$image', '$nis', '$nik', '$class', '$address')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);

    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>alert('data berhasil ditambahkan') </script>";
    } else {
        echo "<script>alert('data gagal ditambahkan') </script>";
    }
}

function updateDataStudent($data, $id)
{
    global $koneksi;
    //var_dump($data);
    $name = $data["name"];
    $gender = $data["gender"];
    $age = $data["age"];
    $image = $data["image"];
    $nis = $data["nis"];
    $nik = $data["nik"];
    $class = $data["class"];
    $address = $data["address"];

    $query = "UPDATE students SET name = '$name', '$gender', '$age', '$image', '$nis', '$nik', '$class', '$address' WHERE id = $id";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
