<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="refresh" content="30">
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Artículos</title>
</head>

<body>
        <?php
        // Incluir los archivos necesarios
        include "funciones.php";
        ?>
        <h1>Artículos</h1>
        <?php
        if (getPermisos() == 1) {
            echo "<a href='formArticulos.php?anadir'>Añadir producto</a>";
        }
        ?>
        <?php
        if (!isset($_COOKIE['datos']) or ($_COOKIE['datos'] != "autorizado")) {
            echo "no tienes permiso para estar aqui.";
        } else { 
                if (!isset($_GET["orden"])) {
                    $orden = "ProductID"; // orden por defecto
                } else {
                    $orden = $_GET["orden"]; // obtener el orden seleccionado por el usuario
                }
                pintaProductos($orden);
        }
        ?>
    <a href="index.php">Volver a la página principal</a>
</body>
</html>