<?php
function crearConexion()
{
    $host = "localhost";
    $user = "root";
    $password = "";
    $baseDatos = "pac_dwes";
    $conexion = mysqli_connect($host, $user, $password, $baseDatos);
    if (!$conexion) {
        // si la conexión falla, devuelve un error con el código de error
        throw new Exception("Error al conectarse a la base de datos: " . mysqli_connect_error());
    }
    return $conexion;
}

function cerrarConexion($conexion)
{
    mysqli_close($conexion);
}
?>