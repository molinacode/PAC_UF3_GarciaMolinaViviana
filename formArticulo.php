<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <link rel="stylesheet" href="">
    <title>Añadir Artículo</title>
</head>
<body>
    <h1>Añadir Artículo</h1>
    <?php
    // Incluir los archivos necesarios
    include "funciones.php";
    include "consultas.php";

    if (!getPermisos() == 1) {
        echo "<p>No tienes permiso para acceder a esta página.</p>";
        echo "<a href='articulos.php'>Volver a la lista de artículos</a>";
        exit();
    }else {
            if (isset($_GET["Editar"])) {
            $datosProducto =  mysqli_fetch_array(getProducto($_GET["Editar"]));
            } else if (isset($_GET["Borrar"])) {
                $datosProducto =  mysqli_fetch_array(getProducto($_GET["Borrar"]));
            }else{
                $datosProducto = ["ProductID" => "", "Name" => "", "Cost" => 0, "Price"=> 0, "Category"=>""];
            }
    }
    ?>
    <div class="content">
    <form method="post" action="formarticulos.php">
        <p><label>ID: </label><input type="text" value="<?php echo $datosProducto["ProductID"];?>" disable>
        <input type="hidden" name="id" value="<?php echo $datosProducto["ProductID"];?>"></p>
        <p><label>Nombre: </label><input type="text" name="name" value="<?php echo $datosProducto["Name"];?>"></p>
        <p><label>Coste: </label><input type="number" name="coste" value="<?php echo $datosProducto["Cost"];?>"></p>
        <p><label>Precio: </label><input type="number" name="precio" value="<?php echo $datosProducto["Price"];?>"></p>
        <p><label>Categoría: </label><select name="categoria">
            <?php
            pintaCategorias($datosProducto["CateogryID"]);
            ?>
        </select></p>
        <?php
        if (isset($_GET["Editar"])) {
            echo "<input type='submit' name='Accion' value='Editar'>";
        }else if(isset($_GET["Borrar"])){
                echo "<input type='submit' name='Accion' value='Borrar'>";
        }else{
            echo "<input type='submit' name='Accion' value='Añadir'>";
        }
        ?>
        <?php
        if (isset($_GET["Accion"])) {
            switch($_GET["Accion"]){
                case 'Editar':
                    if(editarProducto($_GET["id"],$_GET["nombre"],$_GET["coste"],$_GET["precio"],$_GET["categoria"])){
                        echo "Se ha editado el producto.";
                    } else{
                        echo "No se ha editado el producto.";
                    }
                    break;
                case 'Borrar':
                    if(borrarProducto($_GET["id"])){
                        echo "Se ha borrado el producto";
                    } else{
                        echo "No se ha borrado el producto";
                    }
                    break;
                case 'Añadir':
                    if(anadirProducto($_GET["nombre"],$_GET["coste"],$_GET["precio"],$_GET["categoria"])){
                        echo "Se ha añadido el producto.";
                    }else{
                        echo "No se ha añadido el producto.";
                    }
                    break;
            }
        }
        ?>
    </form>
    </div>
    <a href="articulos.php">Volver a la lista de artículos</a>
    
</body>
</html>