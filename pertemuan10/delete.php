<?php 

require 'connect.php';

 $id = $_GET["id"];  

if( deleteStudent($id) > 0 ){
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

function deleteStudent($id){
   global $connect;
   $query = "DELETE FROM students WHERE id = $id";
   mysqli_query($connect, $query);
   return mysqli_affected_rows($connect);
}

echo deleteStudent($id);

?>