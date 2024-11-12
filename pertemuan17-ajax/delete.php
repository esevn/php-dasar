<?php 
session_start(); 

if( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}

require 'connect.php';

 $id = $_GET["id"];  

if( deleteStudent($id, "students") > 0 ){
   echo "
         <script> alert('Delete Succesed!');
         document.location.href = 'index.php';
         </script>";
}else{
   echo "
         <script> alert('Delete Failed!');
         document.location.href = 'index.php';
         </script>";
}

function deleteStudent($id, $table){
   global $connect;
   $query = "DELETE FROM $table WHERE id = $id";
   mysqli_query($connect, $query);
   return mysqli_affected_rows($connect);
}

echo deleteStudent($id,$table);

?>