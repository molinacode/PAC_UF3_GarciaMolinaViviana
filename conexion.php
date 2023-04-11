<?php
function crearConexion (){
    $host = "localhost";
    $user = "root";
    $password = "maneska";
    $baseDatos = "pac_entornos";
    $conexion = mysqli_connect($host,$user,$password,$baseDatos);
    return $conexion;
}
function cerrarConexion($conexion){
    mysqli_close($conexion);
}
?>