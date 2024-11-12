<?php
function totalVolume($a, $b){
    return $a * $a *$a . $b * $b * $b;
}

echo totalVolume(8,8);

function generateID($prefix){
    return strtoupper($prefix) . random_int(1000, 9999);
}

function bioData($nama, $umur, $company, $kerja, $alamat){
    return "Nama $nama, Umur $umur, ID ". generateID($company) .", Kaya kerja di $company, as $kerja,Tinggal di $alamat";
}

echo "<br>";
echo "<br>";
echo bioData("Yazid", 17, "BOR", "Software Enginering", "Bogor");
echo "<br>";

function tambah($i) {
    if($i > 1000) return;
    echo $i . "<br>";
    $i++;
    tambah($i);
}
tambah(1);