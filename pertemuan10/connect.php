<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "blog_school";

$connect = mysqli_connect($server, $user, $password, $database);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

function getData($query) {
    global $connect;
    $result = mysqli_query($connect, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function insertDataStudents($data) {
    global $connect;
    
    $name = htmlspecialchars($data["name"]);
    $gender = htmlspecialchars($data["gender"]);
    $age = htmlspecialchars($data["age"]);
    $image = htmlspecialchars($data["image"]);
    $nis = htmlspecialchars($data["nis"]);
    $nik = htmlspecialchars($data["nik"]);
    $class = htmlspecialchars($data["class"]);
    $address = htmlspecialchars($data["address"]);

    $query = "INSERT INTO students (name, gender, age, image, nis, nik, class, address) 
              VALUES ('$name', '$gender', '$age', '$image', '$nis', '$nik', '$class', '$address')";

    if (mysqli_query($connect, $query)) {
        echo "<script>alert('Completed input data');</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }
}

function showDataStudent($id) {
    global $connect;
    $id = (int)$id; 
    $query = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($connect, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function change($data) {
    global $connect;

    $id = (int)$data["id"]; 
    $name = htmlspecialchars($data["name"]);
    $gender = htmlspecialchars($data["gender"]);
    $age = htmlspecialchars($data["age"]);
    $image = htmlspecialchars($data["image"]);
    $nis = htmlspecialchars($data["nis"]);
    $nik = htmlspecialchars($data["nik"]);
    $class = htmlspecialchars($data["class"]);
    $address = htmlspecialchars($data["address"]);

    $query = "UPDATE students SET
              name = '$name',
              gender = '$gender',
              age = '$age',
              image = '$image',
              nis = '$nis',
              nik = '$nik',
              class = '$class',
              address = '$address'
              WHERE id = $id";

    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

function cari($keyword) {
    $query = "SELECT * FROM students 
              WHERE 
              name LIKE '%$keyword%' OR
              gender LIKE '%$keyword%' OR
              age LIKE '%$keyword%' OR
              nis LIKE '%$keyword%' OR
              nik LIKE '%$keyword%' OR
              class LIKE '%$keyword%' OR
              address LIKE '%$keyword%'";
    return getData($query);   
}
?>
