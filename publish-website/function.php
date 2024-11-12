<?php
$conn = mysqli_connect("localhost", "root", "", "blog_school");

if (!$conn) {
    echo "gagal terhubung" . mysqli_connect_error();
}

function getTables($table, $start = null, $limit = null)
{
    global $conn;
    $queryLimit = '';
    if(isset($start) && isset($limit)){
        $queryLimit = " LIMIT $start, $limit";
    }
    $query = "SELECT * FROM $table $queryLimit";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function getData($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function insertData($data, $file)
{
    global $conn;

    $name = $data["name"];
    $gender = $data["gender"];
    $age = $data["age"];
    $nis = $data["nis"];
    $nik = $data["nik"];
    $class = $data["class"];
    $address = $data["address"];

    $image = uploadImage($file);
    //die;
    if ($image == false) {
        return false;
    }

    $query = "INSERT INTO students VALUES (null, '$name', '$gender', '$age', '$image', '$nis', '$nik', '$class', '$address')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteValue($id, $table)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM $table WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function showDataStudents($id)
{
    global $conn;
    $query = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function updateData($data, $id, $file)
{
    global $conn;

    $name = $data["name"];
    $gender = $data["gender"];
    $age = $data["age"];
    $nis = $data["nis"];
    $nik = $data["nik"];
    $class = $data["class"];
    $address = $data["address"];
    $oldImage = $data["oldImage"];

    if ($file["image"]["error"] == 4) {
        $image = $oldImage;
    } else {
        $image = uploadImage($file);
    }


    $query = "UPDATE students SET name = '$name', gender = '$gender', age = '$age', image = '$image', nis = '$nis', nik = '$nik', class = '$class', address = '$address' WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword, $start = null, $limit = null)
{

    $queryLimit = '';
    if(isset($start) && isset($limit)){
        $queryLimit = " LIMIT $start, $limit";
    }

    $query = "SELECT * FROM students WHERE
     name LIKE '%$keyword%'
     OR gender LIKE '%$keyword%'
     OR age LIKE '%$keyword%'
     OR nis LIKE '%$keyword%'
     OR nik LIKE '%$keyword%'
     OR class LIKE '%$keyword' $queryLimit";

    return getData($query);
}
function uploadImage($data, $oldImage = null)
{
    $namaFile = $data['image']['name'];
    $ukuranFile = $data['image']['size'];
    $error  = $data['image']['error'];
    $tmpName = $data['image']['tmp_name'];

    // cek apakah tidak ada gambar yang di upload
    if ($error === 4) {
        echo "
        <script>
        alert('gambar belum ditambahkan')
        </script>
        ";
        return false;
    }

    $ekstensiFIleValid = ["jpg", "jpeg", "png", "gif"];
    $ekstensiFile = explode(".", $namaFile);
    $resultEkstensi = strtolower(end($ekstensiFile));

    if (!in_array($resultEkstensi, $ekstensiFIleValid)) {
        echo "
        <script>
        alert('File tidak valid !')
        </script>
        ";
        return false;
    }

    if ($ukuranFile > 20000000) {
        echo "
        <script>
        alert('File Kegedeaan')
        </script>
        ";
        return false;
    }

    if ($oldImage == null) {
        $namaFile = generateName($resultEkstensi);
    } else {
        $namaFile = $oldImage;
    }

    move_uploaded_file($tmpName, 'img-profile/' . $namaFile);
    return $namaFile;
}

function generateName($ekstensi)
{
    $name = uniqid() . "." . $ekstensi;
    return $name;
}

function register($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["confirm-password"]);

    if ($password !== $password2) {
        echo "
        <script>
        alert('password tidak sesuai')
        </script>
        ";
        return false;
    }

    $username_db = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($username_db)) {
        echo "
        <script>
        alert('username sudah terdaftar')
        </script>
        ";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    // var_dump($password);
    // die;
    $result = mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");
    return mysqli_affected_rows($conn);
}

function login($data)
{
    global $conn;

    $username = $data["username"];
    $password = $data["password"];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) !== 1) {
        return false;
    }
    $data_db = mysqli_fetch_assoc($result);
    if (!password_verify($password, $data_db["password"])) {
        return false;
    }

    return $data_db;
}
