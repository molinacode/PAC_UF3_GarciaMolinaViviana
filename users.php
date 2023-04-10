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
    <title>Usuarios</title>
</head>
<body>
    <h1>Usuarios</h1>
    <?php
    // Incluir los archivos necesarios
    include "funciones.php";
    include "consultas.php";

    if (getPermisos() == 1) {
        echo "<a href='formUsuarios.php?anadir'>Añadir usuario</a>";
    }
    ?>
    <?php
    if (!isset($_COOKIE['datos']) or ($_COOKIE['datos'] != "autorizado")) {
        echo "No tienes permiso para estar aquí.";
    } else { 
        if (!isset($_GET["orden"])) {
            $orden = "ID"; // orden por defecto
        } else {
            $orden = $_GET["orden"]; // obtener el orden seleccionado por el usuario
        }
        pintaTablaUsuarios($orden);
    }
    ?>
    <a href="index.php">Volver a la página principal</a>
</body>
</html>
