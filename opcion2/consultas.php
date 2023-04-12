<?php
include "conexion.php";
function tipoUsuario($usuario, $email,$id)
{
    $conexion = crearConexion();
    if (esSuperadmin($conexion, $id)) {
        mysqli_close($conexion);
        return 'superadmin';
    } else {
        $query = "SELECT enabled FROM User WHERE full_name = '$usuario' AND Email = '$email'";
        $resultado = mysqli_query($conexion, $query);
        if ($datos = mysqli_fetch_array($resultado)) {
            if ($datos['enabled'] == 0) {
                mysqli_close($conexion);
                return 'registrado';
            } else if ($datos['enabled'] == 1) {
                mysqli_close($conexion);
                return 'autorizado';
            } else {
                mysqli_close($conexion);
                return 'no registrado';
            }
        } else {
            mysqli_close($conexion);
            return 'no registrado';
        }
    }
}
function esSuperadmin($conexion, $id){
    $query = "SELECT * FROM Superadmin WHERE idUsuario = $id";
    $resultado = mysqli_query($conexion, $query);

    if(mysqli_num_rows($resultado) > 0){
        return true;
    } else {
        return false;
    }
}