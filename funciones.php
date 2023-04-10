<?php

include "consultas.php";

function validar_campo($campo)
{
    // Limpia los datos recibidos
    $campo = trim($campo);
    $campo = stripslashes($campo);
    $campo = htmlspecialchars($campo);
    // Realiza la comprobación de si es el email y el user es válido
    // Retorna el campo limpio y validado
    return $campo;
}
function pintaCategorias($defecto)
{
    $categorias = getCategorias();
    foreach ($categorias as $categoria) {
        $selected = ($categoria['CategoryID'] == $defecto) ? 'selected' : '';
        echo "<option value=\"{$categoria['CategoryID']}\" $selected>{$categoria['Name']}</option>";
    }
}
function pintaTablaUsuarios()
{
    $usuarios = getListaUsuarios();
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Email</th><th>Autorizado</th></tr>";
    foreach ($usuarios as $usuario) {
        $enabled = ($usuario['Enabled'] == 1) ? 'class="rojo"' : '';
        echo "<tr><td>{$usuario['FullName']}</td><td>{$usuario['Email']}</td><td $enabled>{$usuario['Enabled']}</td></tr>";
    }
    echo "</table>";
}
function pintaProductos($orden)
{
    $productos = getProductos($orden);
    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Coste</th><th>Precio</th><th>Categoría</th><th>Acciones</th></tr>";
    foreach ($productos as $producto) {
        echo "<tr>";
        echo "<td>{$producto['ProductID']}</td>";
        echo "<td>{$producto['Name']}</td>";
        echo "<td>{$producto['Cost']}</td>";
        echo "<td>{$producto['Price']}</td>";
        echo "<td>{$producto['category_name']}</td>";
        echo "<td><a href=\"editar_producto.php?id={$producto['ProductID']}\">Editar</a> | <a href=\"borrar_producto.php?id={$producto['ProductID']}\">Borrar</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>