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

function getTable($table){
    global $connect;
    $query = "SELECT * FROM $table";
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
    $nis = htmlspecialchars($data["nis"]);
    $nik = htmlspecialchars($data["nik"]);
    $class = htmlspecialchars($data["class"]);
    $address = htmlspecialchars($data["address"]);

    $image = upload();
    if(!$image) {
        return false;
    }

    $query = "INSERT INTO students (name, gender, age, image, nis, nik, class, address) 
              VALUES ('$name', '$gender', '$age', '$image', '$nis', '$nik', '$class', '$address')";

    if (mysqli_query($connect, $query)) {
        echo "<script>alert('Completed input data')
              document.location.href = 'index.php';
              </script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }
}

function upload() {
    $namaFile = $_FILES['image']['name'];
    $sizeFile = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $placeFile = $_FILES['image']['tmp_name'];

    if($error === 4){
        echo "
        <script>
        alert ('Chose file first!');
        </script>";
        return false;
    }

    $eksFileValid = ['jpg', 'png', 'jpeg', 'avif', 'webp', 'gif'];
    $eksFile = explode('.', $namaFile);

    $eksFile = strtolower (end ($eksFile));
    if( !in_array($eksFile, $eksFileValid)){
        echo "
        <script>
        alert ('Not valid!');
        </script>";
        return false;
    }

    if( $sizeFile > 2000000) {
        echo "
        <script>
        alert ('Size not valid!');
        </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $eksFile;


    move_uploaded_file($placeFile, 'img/' . $namaFileBaru);

    return $namaFileBaru;
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
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    $nis = htmlspecialchars($data["nis"]);
    $nik = htmlspecialchars($data["nik"]);
    $class = htmlspecialchars($data["class"]);
    $address = htmlspecialchars($data["address"]);

    if($_FILES['image']['error'] === 4){
        $image = $gambarLama;
    }else{
        $image = upload();
    }

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

function registrasi($data){
    global $connect;

    $username = strtolower (stripslashes($data["username"]));
    $password = mysqli_real_escape_string($connect, $data["password"]);
    $password2 = mysqli_real_escape_string($connect, $data["password2"]);

    $result = mysqli_query($connect, "SELECT username FROM users WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)) {
        echo"
        <script>
        alert ('username used!');
        </script>
        ";

        return false;
    }

    if( $password !== $password2){
        echo"
        <script>
        alert ('password not same!');
        </script>
        ";

        return false;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($connect, "INSERT INTO users VALUES('', '$username', '$password')");

    return mysqli_affected_rows($connect);
}

?>
