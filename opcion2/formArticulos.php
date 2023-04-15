<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Añadir Artículo</title>
</head>
<body>
    <h1>Añadir Artículo</h1>
    <?php
    // Incluir los archivos necesarios
    include "consultas.php";

    if (!getPermisos() == 1) {
        echo "<p>No tienes permiso para acceder a esta página.</p>";
        echo "<a href='articulos.php'>Volver a la lista de artículos</a>";
        exit();
    }else {
            if (isset($_GET['Editar'])) {
            $datosProducto =  mysqli_fetch_array(getProducto($_GET['Editar']));
            } else if (isset($_GET['Borrar'])) {
                $datosProducto =  mysqli_fetch_array(getProducto($_GET['Borrar']));
            }else{
                $datosProducto = ["id" => "", "name" => "", "cost" => 0, "price"=> 0, "category_id"=>""];
            }
    }
    ?>
    
    <form method="post" action="formarticulos.php">
        <p><label>ID: </label><input type="text" value="<?php echo $datosProducto["id"];?>" disable>
        <input type="hidden" name="id" value="<?php echo $datosProducto["id"];?>"></p>
        <p><label>Nombre: </label><input type="text" name="name" value="<?php echo $datosProducto["name"];?>"></p>
        <p><label>Coste: </label><input type="number" name="coste" value="<?php echo $datosProducto["cost"];?>"></p>
        <p><label>Precio: </label><input type="number" name="precio" value="<?php echo $datosProducto["price"];?>"></p>
        <p><label>Categoría: </label><select name="categoria">
            <?php
            pintaCategorias($datosProducto["category_id"]);
            ?>
        </select></p>
        <input type="submit" name="" value="Añadir">
        <input type="submit" name="" value="Editar">
        <input type="submit" name="" value="Borrar">
        <?php
        if (isset($_GET['Accion'])) {
            switch($_GET['Accion']){
                case 'Editar':
                    if(editarProducto($_GET['id'],$_GET['nombre'],$_GET['coste'],$_GET["precio"],$_GET['categoria'])){
                        echo "Se ha editado el producto.";
                    } else{
                        echo "No se ha editado el producto.";
                    }
                    break;
                case 'Borrar':
                    if(borrarProducto($_GET['id'])){
                        echo "Se ha borrado el producto";
                    } else{
                        echo "No se ha borrado el producto";
                    }
                    break;
                case 'Añadir':
                    if(anadirProducto($_GET['nombre'],$_GET['coste'],$_GET['precio'],$_GET['categoria'])){
                        echo "Se ha añadido el producto.";
                    }else{
                        echo "No se ha añadido el producto.";
                    }
                    break;
            }
        }
        ?>
    </form>
    <a href="articulos.php">Volver a la lista de artículos</a>
</body>
</html>