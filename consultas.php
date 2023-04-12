<?php
include "conexion.php";

function tipoUsuario($nombre, $correo){
    $conexion = crearConexion();
    if(esSuperadmin($nombre,$correo)){
        return "superadmin";
    } else {
        $query ="SELECT Enabled full_name, email, enabled FROM User WHERE full_name = '$nombre' AND Email = '$correo'";
        $resultado = mysqli_query($conexion, $query);
        cerrarConexion($conexion);
        if($datos =  mysqli_fetch_array($resultado)){
            if($datos['enabled'] == 0){
                return "registrado";
            } else if ($datos['enabled'] == 1){
                return "autorizado";
            }else {
                return "no registrado";
            }
        }
    }
}
function esSuperadmin($nombre, $correo){
    $conexion = crearConexion();

    // Buscar al usuario en la tabla User
    $query = "SELECT user.id FROM User INNER JOIN setup ON user.id = setup.superadmin_id WHERE user.full_name = '$nombre' AND Email = '$correo'";
    $resultado = mysqli_query($conexion, $query);
    if($datos =  mysqli_fetch_array($resultado)){
        return true;
    } else {
        return false;
    }
}

function getPermisos()
{
    $conexion = crearConexion();
    $consulta = "SELECT management FROM setup;";
    $resultado = mysqli_query($conexion, $consulta);
    $fila = mysqli_fetch_assoc($resultado);
    $autenticacion = $fila['management'];
    mysqli_free_result($resultado);
    cerrarConexion($conexion);
    return $autenticacion;
}
function cambiarPermisos()
{
    $conexion = crearConexion();
    $consulta = "SELECT Autenticacion FROM setup LIMIT 1";
    $resultado = mysqli_query($conexion, $consulta);
    if ($fila = mysqli_fetch_assoc($resultado)) {
        $valor_actual = $fila["Autenticacion"];
        $nuevo_valor = ($valor_actual == 0) ? 1 : 0;
        $consulta = "UPDATE setup SET Autenticacion = $nuevo_valor WHERE 1";
        mysqli_query($conexion, $consulta);
    }
    cerrarConexion($conexion);
}
function getCategorias()
{
    $conexion = crearConexion();
    $consulta = "SELECT CategoryID, Name FROM Category";
    $resultado = mysqli_query($conexion, $consulta);
    cerrarConexion($conexion);
    return $resultado;
}
function getListaUsuarios()
{
    $conexion = crearConexion();
    $query = "SELECT full_name, email, enabled FROM user";
    $resultado = mysqli_query($conexion, $query);
    cerrarConexion($conexion);
    return $resultado;
}


function getProducto($ID)
{

    $conexion = crearConexion();

    // Escapar el ID para prevenir SQL injection
    $ID = mysqli_real_escape_string($conexion, $ID);

    // Consulta SQL para obtener los datos del producto con el ID especificado
    $sql = "SELECT * FROM Product WHERE ProductID = $ID";

    // Ejecutar la consulta
    $resultado = mysqli_query($conexion, $sql);

    // Obtener los datos como un array asociativo
    $producto = mysqli_fetch_assoc($resultado);

    // Cerrar la conexión
    cerrarConexion($conexion);

    // Devolver el array con los datos del producto
    return $producto;
}


function getProductos($orden)
{

    $conexion = crearConexion();

    // Escapamos el valor de $orden para evitar inyección SQL
    $orden = mysqli_real_escape_string($conexion, $orden);

    // Consultamos los productos ordenados por el valor de $orden
    $query = "SELECT ProductID, product.Name, Cost, Price, category.Name as CategoryName 
                FROM product 
                INNER JOIN category ON product.CategoryID = category.CategoryID 
                ORDER BY $orden";
    $result = mysqli_query($conexion, $query);

    // Construimos una tabla virtual con los resultados
    $tabla = '<table>';
    $tabla .= '<tr><th>ID</th><th>Nombre</th><th>Costo</th><th>Precio</th><th>Categoría</th></tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        $tabla .= '<tr>';
        $tabla .= '<td>' . $row['ProductID'] . '</td>';
        $tabla .= '<td>' . $row['Name'] . '</td>';
        $tabla .= '<td>' . $row['Cost'] . '</td>';
        $tabla .= '<td>' . $row['Price'] . '</td>';
        $tabla .= '<td>' . $row['CategoryName'] . '</td>';
        $tabla .= '</tr>';
    }
    $tabla .= '</table>';

    cerrarConexion($conexion);
    return $tabla;
}


function anadirProducto($nombre, $coste, $precio, $categoria)
{
    $conexion = crearConexion();
    $query = "INSERT INTO product (Name, Cost, Price, CategoryID) VALUES ('$nombre', $coste, $precio, $categoria)";
    $resultado = mysqli_query($conexion, $query);
    cerrarConexion($conexion);
    return $resultado;
}


function borrarProducto($id)
{
    $conexion = crearConexion();
    $query = "DELETE FROM product WHERE ProductID = '$id'";
    $resultado = mysqli_query($conexion, $query);
    cerrarConexion($conexion);
    return $resultado;

}


function editarProducto($id, $nombre, $coste, $precio, $categoria)
{
    global $conn;
    $query = "UPDATE product SET Name=?, Cost=?, Price=?, CategoryID=? WHERE ProductID=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $nombre, $coste, $precio, $categoria, $id);
    $stmt->execute();
    return $stmt->affected_rows;
}



?>