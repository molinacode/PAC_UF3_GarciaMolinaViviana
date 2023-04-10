<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="refresh" content="30">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="styles.css">
    <script src=""></script>
    <title>Artículos</title>
</head>
<body>
    <h1>Artículos</h1>
    <?php
    // Incluir los archivos necesarios
    include "funciones.php";
    include "consultas.php";

    if (getPermisos() == 1) {
        echo "<a href='formArticulos.php?anadir'>Añadir producto</a>";
    }
    ?>
    <?php
    if (!isset($_COOKIE['datos']) or ($_COOKIE['datos'] != "autorizado")) {
        echo "no tienes permiso para estar aqui.";
    } else { {
            if (!isset($_GET["orden"])) {
                $orden = "ProductoID"; // orden por defecto
            } else {
                $orden = $_GET["orden"]; // obtener el orden seleccionado por el usuario
            }
            pintaProductos($orden);
        }
    }
    ?>
    <a href="index.php">Volver a la página principal</a>
</body>

</html>