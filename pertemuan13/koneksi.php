<?php

$server = "localhost";
$user = "root";
$pass = "";
$database = "blog_school";

$koneksi = mysqli_connect($server, $user, $pass, $database);

if (!$koneksi) {
    echo "gagal terhubung ke database :" . mysqli_connect_error();
}


// function getdata($query)
// {
//     global $koneksi;
//     // $result = mysqli_query($koneksi, $query);
//     $result = mysqli_query($koneksi, $$query);
//     $rows = [];
//     while ($row = mysqli_fetch_assoc($result)) {
//         $rows[] = $row;
//     }
//     return $rows;
// }
// koneksi.php
function getdata($table)
{
    global $koneksi; // Pastikan $connection telah terhubung dengan database
    if (!empty($table)) {
        $query = "SELECT * FROM " . $table;
        return mysqli_query($koneksi, $query);
    } else {
        echo "Error: Nama tabel tidak boleh kosong.";
        return false;
    }
}

function getTable($table)
{
    global $koneksi;
    $query = "SELECT * FROM . $table";
    $result = mysqli_query($koneksi, $$query);
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

function delete($id, $table)
{
    global $koneksi;

    $query = "DELETE FROM $table WHERE id = $id";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function insertDataStudents($data, $file)
{
    global $koneksi;
    //var_dump($data);
    $name = htmlspecialchars($data["name"]);
    $gender = $data["gender"];
    $age = $data["age"];
    $nis = $data["nis"];
    $nik = $data["nik"];
    $class = $data["class"];
    $address = $data["address"];

    $image = uploadImage($file);

    if ($image == false) {
        return false;
    }

    $query = "INSERT INTO students VALUES
    ('', '$name', '$gender', '$age', '$image', '$nis', '$nik', '$class', '$address')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);

    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>
                alert('data berhasil ditambahkan');
                document.location.href = 'index.php';
            </script>
            ";
    } else {
        echo "<script>
                alert('data gagal ditambahkan');
                document.location.href = 'index.php';
            </script>
            ";
    }

    return mysqli_affected_rows($koneksi);


    function updateDataStudent($data, $id)
    {
        global $koneksi;
        $name = $data["name"];
        $gender = $data["gender"];
        $age = $data["age"];
        $nis = $data["nis"];
        $nik = $data["nik"];
        $class = $data["class"];
        $address = $data["address"];

        $query = "UPDATE students SET name = '$name', '$gender', '$age', '$nis', '$nik', '$class', '$address' WHERE id = $id";

        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }


    // FUNCTION CARI
    function cari($keyword)
    {
        $query = "SELECT * FROM students
    WHERE
    
    name LIKE '%$keyword%' OR
    gender LIKE '%$keyword%' OR
    age LIKE '%$keyword%' OR
    nis LIKE '%$keyword%' OR
    nik LIKE '%$keyword%' OR
    class LIKE '%$keyword%'
    ";

        return getData($query);
    }


    // FUNCTION UPLOAD
    function uploadImage($file)
    {
        $namaFile = $file['image']['name'];
        $ukuranFile = $file['image']['size'];
        $error = $file['image']['error'];
        $tmpName = $file['image']['tmp_name'];

        if ($error === 4) {
            echo "<script>alert('Pilih data terlebih dahulu!!')</script>";

            return false;
        }

        $ekstensi = ["jpg", "jpeg", "png"];

        $ekstensiFile = explode('.', $namaFile);

        // echo end($ekstensiFile);
        $resultEkstensi = strtolower(end($ekstensiFile));
        if (!in_array($resultEkstensi, $ekstensi)) {
            echo "<script>alert('Format yang kamu masukkan salah!!')</script>";

            return false;
        }
        // var_dump($ekstensiFile);

        if ($ukuranFile > 2000000) {
            echo "<script>alert('Ukuran yang kamu masukkan terlalu besar!!')</script>";

            return false;
        }

        if ($old_image = null) {
            $namaField = uniqid();
            $namaField .= ".";
            $namaField .= $resultEkstensi;
            $namaField = generateName($resultEkstensi);
        } else {
            $namaField = $old_image;
        }

        move_uploaded_file($tmpName, 'img/' . $namaField);

        return $namaField;
    }

    function generateName($ekstensi)
    {
        $namaField = uniqid();
        $namaField .= ".";
        $namaField .= $ekstensi;
        return $namaField;
    }
}

// function registrasi($data)
// { 
//         global $koneksi;

//         $username = strtolower(stripslashes($data["username"]));
//         $password = mysqli_real_escape_string($koneksi, $data["password"]);
//         $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

//         $result = mysqli_query($koneksi, "SELECT username FROM users WHERE username");
//         if (mysql_fetch_assoc($result)) {
//             echo "<script>
//         alert('Username Used!');
//         </script>";
//         }

//         return false;
//     }

//     if ($password !== $password) {
//         echo "<script>
//         alert('Password Tidak Valid');
//         </script>";

//         return false;
//     }

//     $password = password_hash($password, PASSWORD_DEFAULT);
//     mysqli_query($koneksi, "INSERT INTO users VALUES('', '$username', '$password')");

//     return mysqli_affected_rows($koneksi);


function registrasi($data)
{
    global $koneksi;

    // Mengamankan inputan username dan password
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    // Cek apakah username sudah ada di database
    $result = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah digunakan!');
            </script>";
        return false;
    }

    // Cek apakah password dan konfirmasi password cocok
    if ($password !== $password2) {
        echo "<script>
                alert('Password tidak valid! Password dan konfirmasi tidak cocok.');
            </script>";
        return false;
    }

    // Mengenkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($koneksi, "INSERT INTO users VALUES ('', '$username', '$password')");

    return mysqli_affected_rows($koneksi);
}
