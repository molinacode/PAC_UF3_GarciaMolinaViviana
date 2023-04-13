<?php
include "conexion.php";
function tipoUsuario($nombre, $correo, $idUsuario){
    $conexion = crearConexion();

    if (esSuperadmin($conexion, $idUsuario)){
        mysqli_close($conexion);
        return 'superadmin';
    } else {
        $query = "SELECT enabled FROM User WHERE full_name = '$nombre' AND Email = '$correo'";
        $resultado = mysqli_query($conexion, $query);

        if($datos =  mysqli_fetch_array($resultado)){
            if($datos['enabled'] == 0){
                mysqli_close($conexion);
                return 'registrado';
            } else if ($datos['enabled'] == 1){
                mysqli_close($conexion);
                return 'autorizado';
            }else {
                mysqli_close($conexion);
                return 'no registrado';
            }
        }else{
            mysqli_close($conexion);
            return 'no registrado';
        }
    }
}
function esSuperadmin($conexion, $idUsuario){
    $query = "SELECT superadmin_id FROM Setup u INNER JOIN user s ON superadmin_id = id WHERE id = $idUsuario";
    $resultado = mysqli_query($conexion, $query);

    if(mysqli_num_rows($resultado) > 0){
        $fila = mysqli_fetch_assoc($resultado);
        if ($fila['superadmin'] == 1) {
            return true;
        }
    }

    return false;
}