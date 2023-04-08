<?php


?>

<!DOCTYPE html>
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
    <title></title>
</head>
<body>
    

</body>
</html>

usuarios.php: contiene el sistema de control sobre los permisos de los usuarios autorizados y muestra el listado de todos los usuarios registrados. Tendrá las siguientes características:
o Comprobará si el acceso a esta página se ha hecho por un usuario que tiene los permisos suficientes, comprobando la cookie creada en index.php.
o Indicará el valor almacenado en la base de datos con los permisos actuales de la aplicación.
o Tendrá un botón que, al pulsar sobre él, cambiará el valor de los permisos de la aplicación.
o Mostrará una tabla con los datos de todos los usuarios registrados en la aplicación con las siguientes columnas: Nombre, Email y Autorizado.
o En aquellos usuarios que estén autorizados, cambiará el color de fondo de la columna de Autorizado.
o Tendrá un enlace que permitirá volver a index.php.
