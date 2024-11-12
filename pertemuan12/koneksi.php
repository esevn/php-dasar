<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "blog_school";


$koneksi = mysqli_connect($server, $user, $pass, $database);


if (!$koneksi) {
    echo "gagal terhubung ke database :" .mysqli_connect_error();
}


function getdata(){
    global $koneksi;
    $query = "SELECT * FROM `students`";
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function deleteStudent($id, $table){
    global $koneksi;
    $query = "DELETE FROM $table WHERE id = $id";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function showDataStudent($id) {
    global $koneksi;
    $query = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}




// get data dari table tanpa dari query


$table = "students";


function ambilData($table){
    global $koneksi;
    $query = "SELECT * FROM $table";
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;


}


// tambah data
function insertDataStudents($data, $file){
    global $koneksi;
    //var_dump($data);
    $name =htmlspecialchars( $data["name"]);
    $gender = $data["gender"];
    $age = $data["age"];
    $nis = $data["nis"];
    $nik = $data["nik"];
    $class = $data["class"];
    $address = $data["address"];


    $image = uploadImage($file);
    if($image == false){
        return false;
    }
   
    // die;


    $query = "INSERT INTO students VALUES
    (null, '$name', '$gender', '$age', '$image', '$nis', '$nik', '$class', '$address')";


    mysqli_query($koneksi, $query);


    return mysqli_affected_rows($koneksi);
}


// edit data
function updateDataStudent($data, $id){
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


// cari data students
function cari($keyword){
    // var_dump($keyword);
     $query = "SELECT * FROM students WHERE
    name LIKE '%$keyword%' OR
    gender LIKE '%$keyword%' OR
    nik LIKE '%$keyword%' OR
    nis LIKE '%$keyword' or
    class LIKE '%$keyword%' ";


    return getdata($query);
}


// uplod image dari file
function uploadImage($file){
    $namaFile = $file['image']['name'];
    $ukuranFile = $file['image']['size'];
    $error = $file['image']['error'];
    $tmpName = $file['image']['tmp_name'];
    $typeFile = $file['image']['type'];


    // cek apakah tidak ada gambar yang diupload
    if($error > 0){
        echo "<script>alert('pilih gambar terlebih dahulu');</script>";
        return false ;
    }


    $ekstensi = ['jpg', 'jpeg', 'png', 'avif', 'webp', 'gif'];


    $ekstensiFile = explode('.', $namaFile);
    $resultEkstensi = strtolower(end($ekstensiFile));
    if(!in_array($resultEkstensi, $ekstensi)){
        echo "<script>
        alert('format yang kamu masukkan salah');
            </script>";
        return false;
    }


    if($ukuranFile > 2000000 ) {
        echo "<script>alert('ukuran terlalu besar');</script>";
        return false ;
    }


    $namaField = uniqid();
    $namaField .= ".";
    $namaField .= $resultEkstensi;


    // echo $namaField;


    move_uploaded_file($tmpName, './img/' . $namaField);


    return $namaField;
}






?>
