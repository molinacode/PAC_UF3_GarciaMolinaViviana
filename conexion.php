<?php
function crearConexion (){
    $host = "localhost";
    $user = "root";
    $password = "";
    $baseDatos = "pac_entornos";
    $conexion = mysqli_connect($host,$user,$password,$baseDatos);
    return $conexion;
}
function cerrarConexion($conexion){
    mysqli_close($conexion);
}
?>