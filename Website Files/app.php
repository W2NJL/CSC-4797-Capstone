<?php

$host_db = "localhost";
$user_db = "root";
$pass_db = "root";
$db_name = "mysql";
$tbl_name = "fcc_db";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM $tbl_name WHERE usuario = '$username'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {     

     $row = $result->fetch_array(MYSQLI_ASSOC);
     if ($password == $row["contra"]) { 
        echo "Success";
     } else { 
       echo "upX";
     }
 }
 else
 {
    echo "upX";
 }
 mysqli_close($conexion);
 ?>