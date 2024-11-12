<?php

require 'function.php';

$id = $_GET['id'];
if (deleteValue($id, "students") > 0) {
    echo "<script> 
    alert('data berhasil di hapus');
    document.location.href = 'index.php'
    </script>
    ";
} else {
    echo "
    <script>
    alert('data gagal dihapus')
    document.location.href = 'index.php'
    </script>
    ";
}
