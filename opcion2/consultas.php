<?php
include "conexion.php";
function tipoUsuario($nombre, $correo){
    $conexion = crearConexion();
    $idUsuario = isset($_COOKIE["datos"]) ? $_COOKIE["datos"] : 0;
    if (esSuperadmin($conexion, $idUsuario)){
        mysqli_close($conexion);
        return 'superadmin';
    } else {
        $query = "SELECT enabled FROM User WHERE full_name = '$nombre' AND email = '$correo'";
        $resultado = mysqli_query($conexion, $query);

        if($datos =  mysqli_fetch_array($resultado)){
            switch ($datos['enabled']) {
                case 0:
                    mysqli_close($conexion);
                    return 'registrado';
                    break;
                case 1:
                    mysqli_close($conexion);
                    return 'autorizado';
                    break;
                default:
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
    $query = "SELECT user.id, setup.superadmin_id FROM user INNER JOIN setup ON user.id = setup.superadmin_id WHERE user.id = $idUsuario";
    $result = mysqli_query($conexion, $query);
        if($fila = mysqli_fetch_assoc($result)){
        }else{
            return false;
        }
    }
function getPermisos(){
    $conexion = crearConexion();
    $query =  "SELECT management FROM setup";
    $result = mysqli_fetch_assoc(mysqli_query($conexion,$query));

    cerrarConexion($conexion);
    return $result['management'];
}

function cambiarPermisos(){
    $conexion = crearConexion();
    $permisos = getPermisos();
    if ($permisos == 0){
        $query = "UPDATE setup SET management = 1";
        $result = mysqli_fetch_assoc(mysqli_query($conexion,$query));
        cerrarConexion($conexion);
        return $result['management'];

    }else if ($permisos == 1){
        $query = "UPDATE setup SET management = 0";
        $result = mysqli_fetch_assoc(mysqli_query($conexion,$query));
        cerrarConexion($conexion);
        return $result['management'];
    }
}
function getCategorias()
{
    $conexion = crearConexion();
    $consulta = "SELECT category_id, Name FROM category";
    $result = mysqli_query($conexion, $consulta);
    cerrarConexion($conexion);
    return $result;
}
function getListaUsuarios()
{
    $conexion = crearConexion();
    $query = "SELECT full_name, email, enabled FROM user";
    $result = mysqli_query($conexion, $query);
    cerrarConexion($conexion);
    return $result;
}


function getProducto($id)
{
    $conexion = crearConexion();
    // Consulta SQL para obtener los datos del producto con el ID especificado
    $sql = "SELECT * FROM Product WHERE id = $id";

    // Ejecutar la consulta
    $result = mysqli_query($conexion, $sql);

    // Obtener los datos como un array asociativo
    $producto = mysqli_fetch_assoc($result);

    // Cerrar la conexión
    cerrarConexion($conexion);

    // Devolver el array con los datos del producto
    return $producto;
}


function getProductos($orden)
{
    $conexion = crearConexion();
    // Consultamos los productos ordenados por el valor de $orden
    $query = "SELECT product.id, product.name, product.cost, product.price, product.category_id as category
                FROM product 
                INNER JOIN category ON product.category_id = category.id
                ORDER BY $orden";
    $result = mysqli_query($conexion, $query);
    // Construimos una tabla virtual con los resultados
    $tabla = '<table>';
    $tabla .= '<tr><th>ID</th><th>Nombre</th><th>Costo</th><th>Precio</th><th>Categoría</th></tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        $tabla .= '<tr>';
        $tabla .= '<td>' . $row['id'] . '</td>';
        $tabla .= '<td>' . $row['name'] . '</td>';
        $tabla .= '<td>' . $row['cost'] . '</td>';
        $tabla .= '<td>' . $row['price'] . '</td>';
        $tabla .= '<td>' . $row['category_id'] . '</td>';
        $tabla .= '</tr>';
    }
    $tabla .= '</table>';
    cerrarConexion($conexion);
    return $tabla;
}


function anadirProducto($nombre, $coste, $precio, $categoria)
{
    $conexion = crearConexion();
    $query = "INSERT INTO product (name, cost, price, category_id) VALUES ('$nombre', $coste, $precio, $categoria)";
    $result = mysqli_query($conexion, $query);
    cerrarConexion($conexion);
    return $result;
}

function borrarProducto($id)
{
    $conexion = crearConexion();
    $query = "DELETE FROM product WHERE id = . $id";
    $result = mysqli_query($conexion, $query);
    cerrarConexion($conexion);
    return $result;
}

function editarProducto($id, $nombre, $coste, $precio, $categoria)
{
    $conexion= crearConexion();
    $query = "UPDATE product SET name=$nombre, cost=$coste, price=$precio, category_id=$categoria WHERE id=$id";
    $result = mysqli_query($conexion, $query);
    cerrarConexion($conexion);
    return $result;
}
?>
