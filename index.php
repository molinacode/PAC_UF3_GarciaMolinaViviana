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
    <?php


    ?>

</body>
</html>

Contiene el sistema de acceso a la aplicación mediante el nombre de usuario y su dirección de correo electrónico. En este fichero se deberá comprobar qué tipo de usuario es y permitir el acceso a la aplicación:
o En caso de ser superadmin, mostrará su nombre y mostrará un enlace para acceder a usuarios.php
o En caso de ser un usuario autorizado, mostrará su nombre y mostrará un enlace para acceder a articulos.php
o En caso de ser un usuario registrado, pero no autorizado, mostrará su nombre e indicará que no tiene permisos para acceder.
o En caso de que sea un usuario no registrado o se introduzcan unos datos incorrectos, indicará que el usuario no está registrado.
o Almacenará en una cookie el tipo de usuario que ha intentado registrarse
