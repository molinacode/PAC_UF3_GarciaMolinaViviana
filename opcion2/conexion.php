<?php
function crearConexion($host, $user, $password, $baseDatos, $puerto = null)
{
    $host = "localhost";
    $user = "root";
    $password = "maneska";
    $baseDatos = "pac_dwes";
    $conexion = mysqli_connect($host, $user, $password, $baseDatos, $puerto);
    if (!$conexion) {
        // si la conexión falla, devuelve un error con el cÃÂ³digo de error
        throw new Exception("Error al conectarse a la base de datos: " . mysqli_connect_error());
    }
    return $conexion;
}

function cerrarConexion($conexion)
{
    mysqli_close($conexion);
}
?>