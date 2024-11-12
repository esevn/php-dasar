<?php

$server = "localhost";
$user = "root";
$pass = "";
$database = "blog_school";

$koneksi = mysqli_connect($server, $user, $pass, $database);

if (!$koneksi) {
    echo "Gagal Terhubung ke database : " . mysqli_connect_error();
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
function getTable($table)
{
    global $koneksi;
    $query = "SELECT * FROM $table";
    $result = mysqli_query($koneksi, $table);
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
function insertDataStudents($data, $file)
{
    global $koneksi;
    // var_dump($data);
    $name = htmlspecialchars($data["name"]);
    $gender = htmlspecialchars($data["gender"]);
    $age = htmlspecialchars($data["age"]);
    $nis = htmlspecialchars($data["nis"]);
    $nik = htmlspecialchars($data["nik"]);
    $class = htmlspecialchars($data["class"]);
    $address = htmlspecialchars($data["address"]);

    $image = uploadImage($file);
    if ($image == false) {
        return false;
    }



    $query = "INSERT INTO students VALUES (null, '$name', '$gender', '$age', '$image', '$nis', '$nik', '$class', '$address')";

    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>
    alert('data berhasil ditambahkan');
    document.location.href = 'index.php';
    </script>";
    } else {
        echo "<script>
    alert('data gagal ditambahkan');
    document.location.href = 'index.php';
    </script>";
    }
}
function updateDataStudents($data, $id, $file)
{
    global $koneksi;
    // var_dump($data);
    $name = htmlspecialchars($data["name"]);
    $gender = htmlspecialchars($data["gender"]);
    $age = htmlspecialchars($data["age"]);
    $image = htmlspecialchars($data["image"]);
    $nis = htmlspecialchars($data["nis"]);
    $nik = htmlspecialchars($data["nik"]);
    $class = htmlspecialchars($data["class"]);
    $address = htmlspecialchars($data["address"]);
    $old_image = htmlspecialchars($data["old_image"]);

    if ($file['image']['eror']) {
        $image = $old_image;
    } else {
        $image = uploadImage($file, $old_image);
    }
    if ($image = false) {
        return false;
    }


    $query = "UPDATE students SET name = '$name', gender = '$gender', age = '$age', image = '$image', nis = '$nis', nik = '$nik', class = '$class', address = '$address', old_image = '$old_image' WHERE id = $id";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
function cari($keyword)
{
    $query = "SELECT * FROM students WHERE name LIKE '%$keyword%' OR nis LIKE '%$keyword%' OR nik LIKE '%$keyword%' OR class LIKE '%$keyword%' OR age LIKE '%$keyword%' OR address LIKE '%$keyword%' OR old_image LIKE '%$keyword%'";

    return getdata($query);
}
function delete($id, $table)
{
    global $koneksi;
    $query = "DELETE FROM $table WHERE id = $id";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function uploadImage($file, $old_image = null)
{
    $namaFile = $file['image']['name'];
    $ukuranFile = $file['image']['size'];
    $error = $file['image']['error'];
    $tmpName = $file['image']['tmp_name'];
    $tmpFile = $file['image']['type'];
    // echo $namaFile;

    if ($error > 0) {
        echo "<script>
    alert('pilih gambar terlebih dahulu');
    </script>";
        return false;
    }

    $ekstensi = ["jpg", "jpeg", "png"];

    $ekstensiFile = explode('.', $namaFile);
    // var_dump($ekstensiFile);
    $resultEkstensi = strtolower(end($ekstensiFile));
    if (!in_array($resultEkstensi, $ekstensi)) {
        echo "<script>
    alert('Format yang masukan salah!');
    </script>";
        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>
    alert('Size File terlalu besar');
    </script>";
        return false;
    }
    if ($old_image == null) {
        $namaFileId = uniqid();
        $namaFileId .= ".";
        $namaFileId .= $resultEkstensi;
    } else {
        $namaFileId = $old_image;
    }


    // echo $namaFileId;
    move_uploaded_file($tmpName, 'profiles/' . $namaFileId);
    return $namaFileId;
}
function generateName($file, $old_image = null)
{
    $namaFile = $file['image']['name'];
    $ukuranFile = $file['image']['size'];
    $error = $file['image']['error'];
    $tmpName = $file['image']['tmp_name'];
    $tmpFile = $file['image']['type'];
    // echo $namaFile;

    if ($error > 0) {
        echo "<script>
    alert('pilih gambar terlebih dahulu');
    </script>";
        return false;
    }

    $ekstensi = ["jpg", "jpeg", "png"];

    $ekstensiFile = explode('.', $namaFile);
    // var_dump($ekstensiFile);
    $resultEkstensi = strtolower(end($ekstensiFile));
    if (!in_array($resultEkstensi, $ekstensi)) {
        echo "<script>
    alert('Format yang masukan salah!');
    </script>";
        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>
    alert('Size File terlalu besar');
    </script>";
        return false;
    }
    if ($old_image == null) {
        $namaFileId = uniqid();
        $namaFileId .= ".";
        $namaFileId .= $resultEkstensi;
    } else {
        $namaFileId = $old_image;
    }


    // echo $namaFileId;
    move_uploaded_file($tmpName, 'profiles/' . $namaFileId);
}
