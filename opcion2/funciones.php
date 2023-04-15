<?php

include "consultas.php";


function pintaCategorias($defecto)
{
    $categorias = getCategorias();
    foreach ($categorias as $categoria) {
        $selected = ($categoria[category_id] == $defecto) ? 'selected' : '';
        echo "<option value=\"{$categoria[category_id]}\" $selected>{$categoria['Name']}</option>";
    }
}
function pintaTablaUsuarios()
{
    $usuarios = getListaUsuarios();
    echo "<table>";
    echo "<tr><th>Nombre Completo</th><th>Email</th><th>Autorizado</th></tr>";
    while ($usuario = mysqli_fetch_assoc($usuarios)) {
        echo '<tr><td>' . $usuario['full_name'] . '</td><td>' . $usuario['email'] . '</td><td>' . $usuario['enabled'] . '</td></tr>';
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
        echo "<td>{$producto['id']}</td>";
        echo "<td>{$producto['name']}</td>";
        echo "<td>{$producto['cost']}</td>";
        echo "<td>{$producto['price']}</td>";
        echo "<td>{$producto['category_id']}</td>";
        echo "<td><a href=\"editar_producto.php?id={$producto['id']}\">Editar</a> | <a href=\"borrar_producto.php?id={$producto['id']}\">Borrar</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>